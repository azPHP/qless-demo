# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|
  config.vm.box = "synapsestudios/synbuntu-1404"

    # NFS file share
    config.vm.synced_folder ".", "/vagrant", type: "nfs", mount_options: ["acregmax=5"]
    config.vm.network 'private_network', ip: '192.168.50.5'

    if Vagrant.has_plugin?("vagrant-cachier")
        config.cache.synced_folder_opts = {
            type: :nfs,
            mount_options: ['rw', 'vers=3', 'tcp', 'nolock']
        }
    end

    config.hostmanager.include_offline = true
    config.hostmanager.ignore_private_ip = false
    config.hostmanager.manage_host = true
    config.hostmanager.aliases = [
        'qless-demo.vm'
    ]

    config.vm.provider 'virtualbox' do |vb|
      vb.customize ['modifyvm', :id, '--natdnshostresolver1', 'on', '--memory', '2048']
      vb.customize ["modifyvm", :id, "--cpus", "2"]
    end
end
