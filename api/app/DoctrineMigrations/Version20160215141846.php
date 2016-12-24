<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160215141846 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO fos_oauth_client VALUES (
            1,
            "1f89qgisf6pwo8cc4s40sogcw0csk4oogsk0w08gkgcwg4s8ks",
            "a:0:{}",
            "64qgef5al1gksosg4og80w0w0wkcscsogs44sgcokk0sc08kc4",
            "a:1:{i:0;s:8:\"password\";}"
            );'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
