desc "Push local changes to Github remote"
task :mirror do
    # Check for any local changes that haven't been committed
    status = %x(git status --porcelain).chomp
    if status != ""
        if status !~ %r{^[M ][M ] config/deploy.rb$}
            raise Capistrano::Error, "Local git repository has uncommitted changes"
        end
    end

    # Check we are on the master branch
    branch = %x(git branch --no-color 2>/dev/null | sed -e '/^[^*]/d' -e 's/* \\(.*\\)/\\1/').chomp
    if branch != "master"
        raise Capistrano::Error, "Not on master branch!"
    end

    # Make sure the github remote has been set up
    remotes = %x(git remote show | sed 'N;s/\\n/ /;').chomp
    if ! remotes.split(' ').include? 'github'
        raise Capistrano::Error, "Github remote not found! Add it by executing: git remote add github git@github.com:belgianpolice/internet-platform.git"
    end

    # Push the changes
    if ! system "git push github master"
        raise Capistrano::Error, "Failed to push changes to github!"
    end
end