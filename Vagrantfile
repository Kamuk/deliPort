Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/xenial64"
  config.vm.box_check_update = false
  config.vm.hostname = "deliport" 
  config.vm.network :private_network, ip: "192.168.33.50"
  config.vm.define "deliport"

  config.vm.synced_folder ".", "/var/www/deliport",
    :owner         => "www-data",
    :group         => "www-data",
    :mount_options => ["dmode=775"]


  # config.vm.provision "install",    type: "shell", inline: $install

end


# $install = <<SCRIPT
# sudo apt-get update
# sudo apt-get install -y software-properties-common curl
# sudo apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D
# sudo apt-add-repository 'deb https://apt.dockerproject.org/repo ubuntu-xenial main'
# sudo apt-get update
# sudo apt-get install -y docker-engine
# sudo apt-get install -y docker-compose
# sudo mkdir /var/data
# cd /var/www/deliport/
# sudo docker-compose -f docker-compose.yml up -d
# echo "Waiting..."
# sleep 10
# sudo docker exec anyport_php_1  sh -c "cd /app && composer install"
# sudo docker exec anyport_mysql_1 mysql -u root -p123123 -e "CREATE DATABASE deliport;"
# sudo docker exec anyport_php_1 php /app/yii migrate/up --interactive=0
# SCRIPT