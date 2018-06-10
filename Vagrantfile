Vagrant.configure(2) do |config|
	config.vm.box = "ubuntu/bionic64"
	
	config.vm.network "private_network", ip: '192.161.235.148'
	
 	config.vm.synced_folder "./", "/var/www/html" , :group => "www-data", :mount_options => ['dmode=775','fmode=664']

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #		cp /vagrant/.provision/nginx_config.conf /etc/nginx/sites-available/default

	config.vm.provider "virtualbox" do |vb|
		# Customize the amount of memory on the VM:
		vb.memory = "2048"
	end

	config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
	config.vm.provision "shell", inline: <<-SHELL
		sudo add-apt-repository ppa:ondrej/php
    	sudo apt-get update
		sudo apt-get install -y composer zip unzip nginx nodejs npm php7.2 php7.2-common php7.2-curl php7.2-xml php7.2-zip php7.2-gd php7.2-mysql php7.2-mbstring php7.2-fpm

		cp /var/www/html/nginx_conf /etc/nginx/sites-enabled/ShipTrack

    	echo ‘cgi.fix_pathinfo=0’ >> /etc/php/7.2/fpm/php.ini
    	echo ‘extension=php_pdo_mysql.dll’ >> /etc/php/7.2/fpm/php.ini

		/etc/init.d/php7.2-fpm restart
		/etc/init.d/nginx restart
	SHELL
end
