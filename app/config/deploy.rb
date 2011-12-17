set   :application,   "sym_test"
set   :deploy_to,     "/home/vertigo2/projects/sym_test"
set   :domain,        "sym_test"

set   :scm,           :git
set   :repository,    "file:///home/vertigo2/projects/symfony_capifony"
set   :deploy_via,    :copy

role  :server,           domain

set   :deploy_via,    :rsync_with_remote_cache
set   :php_bin,       "/opt/lampp/bin/php"

set   :use_sudo,      false
set   :keep_releases, 3
