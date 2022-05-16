# Sistema para gerenciar a lista de atividades (to do list)

[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](code_of_conduct.md)

Este sistema on-line disponibiliza uma lista de atividades a serem realizadas.

As tecnologias na sua criação foram: PHP 7.0 (ou superior) com SQLite 3.36 (ou superior).

# Instalação

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

# Recursos

- Atividades separdas por categorias
- Data de conclusão das atividades
- Descrição das atividades
- Acesso web e móvel

# Contribuindo para este projeto

Este repositório é gerenciado pela drSolutions.

Você pode encontrar a informalção detalhada para contribuir [neste documento](CONTRIBUTING.md).


# FAQ

**Quem pode utilizar essa ferramenta?**

Qualquer pessoa pode utilizar, basta possuir um servidor web, com o PHP instalado.

**Quem pode contribuir?**

Qualuer desenvolvedor pode contribuir, sendo muito bem-vindo! Caso queira contribuir, veja nosso Código de Conduta | [Contributor Covenant Code of Conduct](CODE_OF_CONDUCT.md).

<center><b>We are open source!</b></center>