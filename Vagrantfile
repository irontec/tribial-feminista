# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    ENV['VAGRANT_DEFAULT_PROVIDER'] = 'docker'

    environment = ENV["VAGRANT_ENVIRONMENT"]

    if environment == nil || environment == ""
        environment = "development"
    end

    tags = ENV["ANSIBLE_TAGS"]

    #if tags == nil || tags == "all" || tags == "ALL" || tags == "All"
    #    tags = ["common", environment]
    #end
    tags = ["common"]

    config.vm.provider "docker" do |d|
        d.build_dir = "./"
	#d.image = "abejaruco/debian:wheezy"
        d.has_ssh = true
        d.name = "tribialfeminista"
        d.ports = ["8050:80", "9900:9000"]
        d.build_args = ["-t=tribialfeminista"]
        d.create_args = ["-h", "tribialfeminista"]
    end

    config.ssh.port = 22
    config.ssh.username  = "vagrant"
    config.ssh.password = "vagrant"

  config.vm.synced_folder "./", "/vagrant"
  config.vm.synced_folder "/opt/klear-development/", "/opt/klear-development"

  config.vm.provision "ansible" do |ansible|
     ansible.playbook = "Provision/playbook.yml"
     ansible.tags = tags
     ansible.verbose = "vvvv"
  end

end
