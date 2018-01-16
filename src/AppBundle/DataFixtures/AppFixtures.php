<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Article;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\competence;
use AppBundle\Entity\Presentation;
use AppBundle\Entity\Realisation;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $presentation = new Presentation();
        $presentation->setNom('Robin ZAMORA');
        $presentation->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $presentation->setImgpath('/ZamoraCV/web/images/profil3last.svg');
        $manager->persist($presentation);

        $competence = new competence();
        $competence->setTitre('PHP');
        $competence->setDescription('Symfony & Laravel');
        $competence->setNote(90);
        $manager->persist($competence);

        $competence = new competence();
        $competence->setTitre('HTML/CSS');
        $competence->setDescription('Bootstrap');
        $competence->setNote(70);
        $manager->persist($competence);

        $competence = new competence();
        $competence->setTitre('JAVA');
        $competence->setDescription('Création Système Expert');
        $competence->setNote(60);
        $manager->persist($competence);

        $competence = new competence();
        $competence->setTitre('JAVASCRIPT');
        $competence->setDescription('JQuery');
        $competence->setNote(40);
        $manager->persist($competence);

        $competence = new competence();
        $competence->setTitre('SQL');
        $competence->setDescription('Certifié Oracle Database 11g');
        $competence->setNote(70);
        $manager->persist($competence);

        $user = new User();
        $user->setUsername('Admin');
        $user->setEmail('admin@mail.com');
        $user->setEnabled(true);
        $password = $this->encoder->encodePassword($user, 'azerty');
        $user->setPassword($password);
        $user->setRoles(["ROLE_SUPER_ADMIN"]);

        $manager->persist($user);
        
        $user2 = new User();
        $user2->setUsername('user1');
        $user2->setEmail('user1@mail.com');
        $user2->setPassword('azerty');
        $user2->setEnabled(true);
        $password = $this->encoder->encodePassword($user2, 'azerty');
        $user2->setPassword($password);
        $manager->persist($user2);

        $realisation = new Realisation();
        $realisation->setTitre('Bataille Navale Python');
        $realisation->setDescription('Curabitur vel efficitur purus. Sed eget libero scelerisque, rhoncus nisi sit amet, sodales dui. Sed non sodales urna, vel gravida ipsum. Vestibulum venenatis commodo rhoncus. Nulla id scelerisque elit, et molestie erat. Phasellus sodales enim at nibh vestibulum faucibus. Pellentesque posuere eleifend dui, sed fermentum metus faucibus et. Nullam efficitur sed nunc et pharetra. Aenean magna ligula, aliquet sed cursus nec, rutrum at sapien. Vestibulum viverra dui rutrum arcu mollis pulvinar. Quisque molestie nibh quis rhoncus bibendum. Vivamus posuere nunc sit amet ornare euismod. Aenean sed lorem rutrum, laoreet elit nec, faucibus est. Praesent blandit eu nisi sit amet tempus. Nullam volutpat dui nec sem aliquam, quis molestie felis molestie.');
        $realisation->setImgpath('/ZamoraCV/web/images/bataille-navale.jpg');
        $manager->persist($realisation);

        $realisation = new Realisation();
        $realisation->setTitre('Abiflizera SEO');
        $realisation->setDescription('Duis interdum libero sit amet malesuada suscipit. Ut non diam risus. Integer quis metus ut ante sagittis mollis. Nullam ex diam, vulputate rhoncus ipsum vitae, porttitor vestibulum ipsum. Curabitur tempus facilisis nisi non laoreet. Etiam in erat suscipit, convallis diam non, dignissim metus. Maecenas id ex dui. Integer sit amet orci rhoncus tellus maximus mattis vitae sit amet est. Mauris ac sem gravida, finibus erat lacinia, varius nisi. Ut tortor ipsum, pellentesque ut nisi ac, pharetra facilisis risus. Curabitur vehicula ullamcorper augue, vel viverra nulla vulputate in.');
        $realisation->setImgpath('/ZamoraCV/web/images/abiflizera.jpg');
        $manager->persist($realisation);

        $article = new Article();
        $article->setTitre('Article 1');
        $article->setContenu('Quisque non enim ac neque tincidunt sagittis. Maecenas ac quam ac massa efficitur condimentum eget eu lorem. Nam at euismod est. Proin semper interdum neque in auctor. Integer facilisis velit vel magna aliquam, tempor pharetra odio venenatis. Cras ultrices sem et nisi euismod, nec molestie odio rutrum. Nullam dictum tellus elit, a tincidunt libero ornare at. Sed diam orci, lacinia eu metus eget, interdum facilisis tortor. Vestibulum interdum mi ac est ultrices, in rhoncus arcu imperdiet. Proin enim lectus, suscipit ac ante quis, dapibus feugiat eros. Pellentesque sit amet magna et quam malesuada porta id in dolor. Sed auctor velit risus, nec sagittis lacus gravida at. Vivamus tempus ex vitae ex euismod, eu laoreet lacus rhoncus.');;
        $commentaire1 = new Commentaire();
        $commentaire1->setContenu('C est de toute beauté !');

        $commentaire2 = new Commentaire();
        $commentaire2->setContenu('Site réalisé par Robin ZAMORA');

        // On lie les commentaires à l'article
        $commentaire1->setArticle($article);
        $commentaire1->setUser($user);
        $commentaire2->setArticle($article);
        $commentaire2->setUser($user2);


        $manager->persist($article);
        $manager->persist($commentaire1);
        $manager->persist($commentaire2);

        $article = new Article();
        $article->setTitre('Article 2');
        $article->setContenu('Sed ac semper dolor. Mauris volutpat turpis ac metus sollicitudin, vitae hendrerit enim fringilla. Aliquam erat volutpat. Praesent vitae ligula sit amet diam sollicitudin hendrerit. Sed sit amet pretium tortor, nec auctor felis. Etiam quis laoreet nisl, in luctus dolor. Vivamus mi dolor, tincidunt ut semper eget, pulvinar ac metus.');;
        $manager->persist($article);


        $manager->flush();
    }
}