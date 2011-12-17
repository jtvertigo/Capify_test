set   :application,   "sym_test"
set   :deploy_to,     "/home/vertigo2/projects/sym_test"
set   :domain,        "sym_test"

set   :scm,           :git
set   :repository,    "git://github.com/jtvertigo/Capify_test.git"
set   :deploy_via,    :copy

role  :server,        domain

set   :use_sudo,      false
set   :keep_releases, 3
