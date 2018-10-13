<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181013101732 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE assignexamtostudents (id INT AUTO_INCREMENT NOT NULL, examid INT NOT NULL, studentid INT NOT NULL, assigndate DATETIME NOT NULL, startrange DATETIME NOT NULL, endrange DATETIME NOT NULL, selecteddate DATETIME NOT NULL, selectedtime DATETIME NOT NULL, is_confirmed TINYINT(1) NOT NULL, results INT NOT NULL, showtostudents TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assignquestiontoexam (id INT AUTO_INCREMENT NOT NULL, questionid INT NOT NULL, examid INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exams (id INT AUTO_INCREMENT NOT NULL, category SMALLINT NOT NULL, teacherid INT NOT NULL, createddate DATETIME NOT NULL, canchange TINYINT(1) NOT NULL, description TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE assignexamtostudents');
        $this->addSql('DROP TABLE assignquestiontoexam');
        $this->addSql('DROP TABLE exams');
    }
}
