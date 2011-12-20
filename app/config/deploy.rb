set   :application,   "sym_test"
set   :deploy_to,     "/home/vertigo3/sites/sym_test"
set   :domain,        "192.168.1.40"

set   :scm,           :git
set   :repository,    "file:///home/vertigo2/projects/symfony_capifony"
set   :deploy_via,    :copy

role  :server,        domain

set   :deploy_via,    :rsync_with_remote_cache

# PHP bin path on remote server
set   :php_bin,       "/opt/lampp/bin/php"

set   :use_sudo,      false
set   :keep_releases, 3

# ./bin/vendors
set   :update_vendors, false

# SSH-user
set :user, "vertigo3"

set :shared_files,      ["app/config/parameters.ini"]

# SSH-password
# set :password, "vert123"

# set environment ?!
# set :symfony_env_prod, "prod"
# set :symfony_env_dev,  "dev"
