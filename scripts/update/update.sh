#!/usr/bin/env sh

#:     Title: Update Nooku Platform
#:  Synopsis: update
#:    Author: Gergo Erdosi
#: Copyright: Copyright (C) 2011 - 2013 Timble CVBA and Contributors. (http://www.timble.net).

## Variable initialization
repo=$(cd "$(dirname $0)/../.."; pwd -P)
branch="master"
temp="/tmp/police-$RANDOM"

dirs=(
  "application/admin/component/about"
  "application/admin/component/announcements"
  "application/admin/component/bin"
  "application/admin/component/contacts"
  "application/admin/component/districts"
  "application/admin/component/news"
  "application/admin/component/police"
  "application/admin/component/press"
  "application/admin/component/questions"
  "application/admin/component/streets"
  "application/admin/component/support"
  "application/admin/component/traffic"
  "application/admin/component/trafficinfo"
  "application/admin/component/uploads"
  "application/admin/component/zendesk"
  "application/admin/public/theme/default/templates"
  "application/manager"
  "application/site/component/about"
  "application/site/component/bin"
  "application/site/component/contacts"
  "application/site/component/districts"
  "application/site/component/news"
  "application/site/component/police"
  "application/site/component/press"
  "application/site/component/questions"
  "application/site/component/streets"
  "application/site/component/traffic"
  "application/site/component/trafficinfo"
  "application/site/public/theme/mobile"
  "application/site/public/theme/portal"
  "component/about"
  "component/announcements"
  "component/bin"
  "component/contacts"
  "component/districts"
  "component/elasticsearch"
  "component/mailer"
  "component/news"
  "component/police"
  "component/press"
  "component/questions"
  "component/sendgrid"
  "component/slack"
  "component/streets"
  "component/support"
  "component/swiftmailer"
  "component/traffic"
  "component/trafficinfo"
  "component/uploads"
  "install/custom"
)

files=(
  ".gitignore"
  "README.md"
  "Vagrantfile"
  "vendor/.gitignore"
  "config/config.php"
  "application/admin/component/application/resources/language/nl-NL.ini"
  "application/admin/component/application/resources/language/fr-FR.ini"
  "application/site/component/application/resources/language/nl-NL.ini"
  "application/site/component/application/resources/language/fr-FR.ini"
  "application/site/component/files/resources/language/nl-NL.ini"
  "application/site/component/files/resources/language/fr-FR.ini"
  "component/ckeditor/resources/assets/ckeditor/config.js"
)

## Function definitions
die() #@ DESCRIPTION: print error message and exit with supplied return code
{     #@ USAGE: die STATUS [MESSAGE]
  error=$1
  shift
  [ -n "$*" ] && printf "$(tput setaf 1)%s$(tput sgr0)\n" "$*" >&2
  exit "$error"
}

# Test Git version
[[ $(git --version) =~ ([0-9]*)\.([0-9]*) ]]
if test ${BASH_REMATCH[1]} -eq 1 -a ${BASH_REMATCH[2]} -lt 7
then
  die 1 "Git 1.7 or newer is required."
fi

# Make sure we are in a feature branch
BRANCH=$(git symbolic-ref --short -q HEAD)
if [[ $BRANCH != feature/* ]]
then
  die 1 "You can only update the platform on a feature branch."
fi

# Test if Git repository is empty
if test -n "$(git status --porcelain)"
then
  die 1 "Working directory is not clean. Please commit and push your changes."
fi

# Backup custom files
printf "$(tput bold)%s$(tput sgr0)\n" "Backing up custom files..."
mkdir "$temp"

for dir in "${dirs[@]}"
do
  printf "%s\n" "$dir"
  mkdir -p "$temp/directories/$dir" && cp -r "$repo/$dir/" "$temp/directories/$dir"
done

for file in "${files[@]}"
do
  printf "%s\n" "$file"
  mkdir -p "$(dirname $temp/files/$file)" && cp -r "$repo/$file" "$(dirname $temp/files/$file)"
done

# Update Nooku Platform
printf "$(tput bold)%s$(tput sgr0)\n" "Updating Nooku Platform..."
mkdir -p "$HOME/.git-cache"

if test ! -d "$HOME/.git-cache/nooku-platform"
then
  git clone --quiet git@github.com:nooku/nooku-platform.git $HOME/.git-cache/nooku-platform
fi

cd "$HOME/.git-cache/nooku-platform"
git fetch origin $branch
git checkout $branch
git pull --rebase

rm -rf "$repo/application" "$repo/component" "$repo/config" "$repo/library" "$repo/install" "$repo/vendor"
rm "$repo/LICENSE.md" "$repo/README.md"
rsync -a --exclude='.git' "$HOME/.git-cache/nooku-platform/" "$repo"

# Move custom files back into repository
printf "$(tput bold)%s$(tput sgr0)\n" "Moving custom files back into repository..."

for dir in "${dirs[@]}"
do
  mkdir -p "$repo/$dir" && cp -r "$temp/directories/$dir/" "$repo/$dir"
done

for file in "${files[@]}"
do
  cp -r "$temp/files/$file" "$(dirname $repo/$file)"
done

rm -rf "$temp"

# Temporarily making sure updates don't break the proxy configuration
# by replacing the proxies array() with the proxy being used on the server.
sed -i '' "s/\'proxies\' => array()/\'proxies\' => array('127.0.0.1')/g" "$repo/library/dispatcher/request/abstract.php"

# Test if there was a conflict.
cd "$repo"

if test -n "$(git diff --name-only --diff-filter=U)"
then
  die 1 "Automatic merge failed. Fix conflicts and then commit the result."
fi

# Commit changes.
printf "$(tput bold)%s$(tput sgr0)\n" "Committing merged files..."
cd "$repo"

find . -path ./.git -prune -type d -print0 | xargs -0 chmod 0775
find . -path ./.git -prune -type f -print0 | xargs -0 chmod 0664

git add -A
# git commit -m "Update Nooku Platform.
#
# Branch: origin/$branch
# Commit: $(git --git-dir=$HOME/.git-cache/nooku-platform/.git rev-parse origin/$branch)"

# Composer
printf "$(tput bold)%s$(tput sgr0)\n" "Running custom composer..."
cd "$repo/install/custom"
composer install
