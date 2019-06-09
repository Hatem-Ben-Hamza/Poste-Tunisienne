

## Instructions :


1.`Composer update`<br />
2. `symfony/app/config/parameters.yml`: change dbname<br />
3. `php bin/console doctrine:schema:update --force`<br />
4. `php bin/console server:run`<br />

## To add Admin role to a specific user :

`php bin/console fos:user:promote` : enter username and 'ROLE_ADMIN'


## Administration Dashebord : /dashebord


