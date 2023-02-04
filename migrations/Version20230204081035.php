<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230204081035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE links_map_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE links_map (id INT NOT NULL, name VARCHAR(50) DEFAULT \'\', original_link VARCHAR(1000) DEFAULT NULL, short_link_slug VARCHAR(50) DEFAULT NULL, last_update TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users_links (user_id INT NOT NULL, lm_id INT NOT NULL, PRIMARY KEY(user_id, lm_id))');
        $this->addSql('CREATE INDEX IDX_36F50551A76ED395 ON users_links (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36F50551CAAC5EAD ON users_links (lm_id)');
        $this->addSql('ALTER TABLE users_links ADD CONSTRAINT FK_36F50551A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_links ADD CONSTRAINT FK_36F50551CAAC5EAD FOREIGN KEY (lm_id) REFERENCES links_map (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE links_map_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('ALTER TABLE users_links DROP CONSTRAINT FK_36F50551A76ED395');
        $this->addSql('ALTER TABLE users_links DROP CONSTRAINT FK_36F50551CAAC5EAD');
        $this->addSql('DROP TABLE links_map');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE users_links');
    }
}
