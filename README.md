# Sistema para gerenciar a lista de atividades (to do list)

Tecnologias: PHP 7.0 (ou superior) com SQLite 3.36 (ou superior)
 
Author: Diego Mendes Rodrigues

Data: Julho/2021

Versão: 1.0

## Instalar o SQLite3 no PHP

```
$ sudo apt-get install php7.0-sqlite3
$ sudo systemctl restart apache2.service
```

## Criar uma autenticação básica com o Apache

```
root@www:~# apt-get -y install apache2-utils 

root@www:~# nano /etc/apache2/sites-available/auth-atividades.conf

# Novo arquivo
<Directory /var/www/drsolutions-com-br/html/atividades>
    AuthType Basic
    AuthName "Autenticação"
    AuthUserFile /etc/apache2/.htpasswd
    require valid-user
</Directory>

# Adicionar o usuário no .htpasswd
root@www:~# htpasswd -c /etc/apache2/.htpasswd diego
New password:     # set password
Re-type new password:
Adding password for user diego

# Habilitar o site protegido no Apache
root@www:~# a2ensite auth-atividades
Enabling site auth-atividades.
To activate the new configuration, you need to run:
  systemctl reload apache2

# Reiniciar o Apache para aplicar as alterações
root@www:~# systemctl restart apache2
```