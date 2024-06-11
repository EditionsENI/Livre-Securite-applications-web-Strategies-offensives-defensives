#!/bin/bash

# Mise à jour des paquets
echo "Mise à jour des paquets..."
apt-get update

# Installation des dépendances
echo "Installation des dépendances..."
apt-get install -y php-xml php-curl

# Redémarrer MySQL
echo "Redémarrage de MySQL..."
service mysql restart
echo "MySQL redémarré."

# Paramètres de connexion à la base de données
DB_USER="root"
DB_HOST="localhost"
DB_PASSWORD="root"

# Commande SQL permettant la connexion
SQL_QUERY="ALTER USER '$DB_USER'@'$DB_HOST' IDENTIFIED BY '$DB_PASSWORD' PASSWORD EXPIRE NEVER;"

# Exécution de la commande SQL avec la commande mysql
echo "Connexion à la base de données et modification du mot de passe..."
mysql -u"$DB_USER" -p"$DB_PASSWORD" -e "$SQL_QUERY"
echo "Mot de passe modifié."

echo "Donner des droits d'écriture pour les exercices nécessaires..."
# Donner des droits d'écriture pour les exercices nécessaires
chmod -R a+w ../exercices/idor/idor_5/users
chmod -R a+w ../exercices/sqli/sqli_9/public/
chmod -R a+w ../exercices/osinjection/osinjection_2/users
chmod -R a+w ../exercices/codeinjection/codeinjection_2/uploads
chown -R kali: ../exercices/  

# Modifier la directive allow_url_include
echo "Modification de la directive allow_url_include..."
sed -i 's/^allow_url_include = Off/allow_url_include = On/' /etc/php/$(php -v | awk 'NR==1{print $2}' | cut -d. -f1,2)/apache2/php.ini

# Redémarrer Apache2
echo "Redémarrage d'Apache2..."
service apache2 restart
echo "Apache2 redémarré."

# Redémarrer MySQL
echo "Redémarrage de MySQL..."
service mysql restart
echo "MySQL redémarré."