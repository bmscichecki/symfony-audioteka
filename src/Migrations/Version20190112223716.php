<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190112223716 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, author_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disc (id INT AUTO_INCREMENT NOT NULL, genre_id_id INT NOT NULL, author_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_2AF5530C2428192 (genre_id_id), INDEX IDX_2AF553069CCBE9A (author_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, genre_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE disc ADD CONSTRAINT FK_2AF5530C2428192 FOREIGN KEY (genre_id_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE disc ADD CONSTRAINT FK_2AF553069CCBE9A FOREIGN KEY (author_id_id) REFERENCES author (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE disc DROP FOREIGN KEY FK_2AF553069CCBE9A');
        $this->addSql('ALTER TABLE disc DROP FOREIGN KEY FK_2AF5530C2428192');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE disc');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE user');
    }
}
