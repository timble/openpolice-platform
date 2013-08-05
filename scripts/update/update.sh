#!/usr/bin/env sh

#:     Title: Update Nooku Framework
#:  Synopsis: update
#:    Author: Gergo Erdosi
#: Copyright: Copyright (C) 2011 - 2013 Timble CVBA and Contributors. (http://www.timble.net).

## Variable initialization
repo=$(cd "$(dirname $0)/../.."; pwd -P)
branch="develop"
temp="/tmp/police-$RANDOM"

dirs=(
  "application/admin/component/districts"
  "application/admin/component/news"
  "application/admin/component/police"
  "application/admin/component/streets"
  "application/admin/component/traffic"
  "application/admin/component/trafficinfo"
  "application/admin/component/questions"
  "application/site/component/districts"
  "application/site/component/news"
  "application/site/component/police"
  "application/site/component/streets"
  "application/site/component/traffic"
  "application/site/component/trafficinfo"
  "application/site/component/questions"
  "application/site/public/theme/mobile"
  "application/site/public/theme/splash"
  "component/districts"
  "component/news"
  "component/police"
  "component/streets"
  "component/traffic"
  "component/trafficinfo"
  "component/questions"
  "install/custom"
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
  mkdir -p "$temp/$dir" && cp -r "$repo/$dir/" "$temp/$dir"
done

if [ -f "$repo/config/config.php" ]
then
  printf "%s\n" "config.php"
  cp "$repo/config/config.php" $temp
fi

# Update Nooku Framework
printf "$(tput bold)%s$(tput sgr0)\n" "Updating Nooku Framework..."
mkdir -p "$HOME/.git-cache"

if test ! -d "$HOME/.git-cache/nooku-framework"
then
  git clone --quiet git@git.assembla.com:nooku-framework.git $HOME/.git-cache/nooku-framework
fi

cd "$HOME/.git-cache/nooku-framework"
git fetch origin $branch
git checkout $branch
git pull --rebase

rm -rf "$repo/application" "$repo/component" "$repo/config" "$repo/library" "$repo/install" "$repo/vendor"
rm "$repo/LICENSE.md" "$repo/README.md"
rsync -a --exclude='.git' "$HOME/.git-cache/nooku-framework/" "$repo"

# Move custom files back into repository
printf "$(tput bold)%s$(tput sgr0)\n" "Moving custom files back into repository..."

for dir in "${dirs[@]}"
do
  mkdir -p "$repo/$dir" && cp -r "$temp/$dir/" "$repo/$dir"
done

if [ -f "$temp/config.php" ]
then
  cp "$temp/config.php" "$repo/config/config.php"
fi

rm -rf "$temp"

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
git commit -m "Update Nooku Framework.

Branch: origin/$branch
Commit: $(git --git-dir=$HOME/.git-cache/nooku-framework/.git rev-parse origin/$branch)"

# Composer
printf "$(tput bold)%s$(tput sgr0)\n" "Running custom composer..."
cd "$repo/install/custom"
composer install