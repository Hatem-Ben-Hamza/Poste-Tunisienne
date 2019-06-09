

## Instructions :


1.`Composer update`
2. `symfony/app/config/parameters.yml`: change dbname
3. `php bin/console doctrine:schema:update --force`
4. `php bin/console server:run`

## To add Admin role to a specific user :

`php bin/console fos:user:promote` : enter username and 'ROLE_ADMIN'




