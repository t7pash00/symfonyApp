<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181017141918 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, questionid INT NOT NULL, ansdescription VARCHAR(255) NOT NULL, iscorrect TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assignexamtostudents (id INT AUTO_INCREMENT NOT NULL, examid INT NOT NULL, studentid INT NOT NULL, assigndate DATETIME NOT NULL, startrange DATETIME NOT NULL, endrange DATETIME NOT NULL, selecteddate DATETIME NOT NULL, selectedtime TIME NOT NULL, isconfirmed TINYINT(1) NOT NULL, result INT NOT NULL, showtostudent TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assignquestiontoexam (id INT AUTO_INCREMENT NOT NULL, questionid INT NOT NULL, examid INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edu_users (id INT AUTO_INCREMENT NOT NULL, u_name VARCHAR(255) NOT NULL, u_email VARCHAR(255) NOT NULL, u_password VARCHAR(255) NOT NULL, u_type TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exams (id INT AUTO_INCREMENT NOT NULL, category SMALLINT NOT NULL, teacherid INT NOT NULL, createddate DATETIME NOT NULL, canchange TINYINT(1) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, qdescription VARCHAR(255) NOT NULL, qcategory SMALLINT NOT NULL, qdifficultylevel SMALLINT NOT NULL, userid INT NOT NULL, canedit TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, t1 VARCHAR(255) NOT NULL, t2 VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, first_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE assignexamtostudents');
        $this->addSql('DROP TABLE assignquestiontoexam');
        $this->addSql('DROP TABLE edu_users');
        $this->addSql('DROP TABLE exams');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE user');
    }
}
