<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190122134134 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE disc DROP FOREIGN KEY FK_2AF55303DAE168B');
        $this->addSql('DROP INDEX IDX_2AF55303DAE168B ON disc');
        $this->addSql('ALTER TABLE disc DROP list_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DAE168B');
        $this->addSql('DROP INDEX IDX_8D93D6493DAE168B ON user');
        $this->addSql('ALTER TABLE user DROP list_id, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user_catalog ADD user_id_id INT NOT NULL, ADD disc_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_catalog ADD CONSTRAINT FK_43212C4D9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_catalog ADD CONSTRAINT FK_43212C4D1779E8E0 FOREIGN KEY (disc_id_id) REFERENCES disc (id)');
        $this->addSql('CREATE INDEX IDX_43212C4D9D86650F ON user_catalog (user_id_id)');
        $this->addSql('CREATE INDEX IDX_43212C4D1779E8E0 ON user_catalog (disc_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE disc ADD list_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE disc ADD CONSTRAINT FK_2AF55303DAE168B FOREIGN KEY (list_id) REFERENCES user_catalog (id)');
        $this->addSql('CREATE INDEX IDX_2AF55303DAE168B ON disc (list_id)');
        $this->addSql('ALTER TABLE user ADD list_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DAE168B FOREIGN KEY (list_id) REFERENCES user_catalog (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6493DAE168B ON user (list_id)');
        $this->addSql('ALTER TABLE user_catalog DROP FOREIGN KEY FK_43212C4D9D86650F');
        $this->addSql('ALTER TABLE user_catalog DROP FOREIGN KEY FK_43212C4D1779E8E0');
        $this->addSql('DROP INDEX IDX_43212C4D9D86650F ON user_catalog');
        $this->addSql('DROP INDEX IDX_43212C4D1779E8E0 ON user_catalog');
        $this->addSql('ALTER TABLE user_catalog DROP user_id_id, DROP disc_id_id');
    }
}
