<?php
/**
 * User: Jakub Kohout <jakub@eastbiz.com>
 * Date: 1/12/14
 * Time: 11:20 AM
 */

namespace Hermes\ModelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hermes\ModelBundle\Entity\Category;
use Hermes\ModelBundle\Entity\Country;
use Hermes\ModelBundle\Entity\Employee;
use Hermes\ModelBundle\Entity\Office;
use Hermes\ModelBundle\Entity\Type;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadEntities implements FixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $generator = \Faker\Factory::create();
        $generator->addProvider(new CS_CZ_ADDRESS($generator));
        $populator = new \Faker\ORM\Doctrine\Populator($generator, $manager);
        $populator->addEntity('Hermes\\ModelBundle\\Entity\\Customer', 8500,
            array(
                'personal_number' => function() use ($generator) { return $generator->randomNumber(60,95) . $generator->month() . $generator->dayOfMonth() .'/'.$generator->randomNumber(4);}
            ));

        $populator->addEntity('Hermes\\ModelBundle\\Entity\\Participant', 10000,
            array(
                'personal_number' => function() use ($generator) { return $generator->randomNumber(60,95) . $generator->month() . $generator->dayOfMonth() .'/'.$generator->randomNumber(4);}
            ));

        $populator->addEntity('Hermes\\ModelBundle\\Entity\\Office', 10, array(
            'name' => function() use ($generator) {return $generator->getCity();}
        ));

        $populator->addEntity('Hermes\\ModelBundle\\Entity\\Employee', 10, array(
        ));


        $countries = $this->loadCountries($manager);
        $types = $this->loadTypes($manager);
        $categories = $this->loadCategories($manager);


        $populator->addEntity('Hermes\\ModelBundle\\Entity\\Trip', 400,
            array(
                'type' => function() use ($generator, $types) {return $types[$generator->randomNumber(0, count($types) - 1)];},
                'category' => function() use ($generator, $categories) {return $categories[$generator->randomNumber(0, count($categories) - 1)];},
                'country' => function() use ($generator, $countries) {return $countries[$generator->randomNumber(0, count($countries) - 1)];}
        ));

        $populator->addEntity('Hermes\\ModelBundle\\Entity\\Contract', 15000,
            array(
                'price' => function() use ($generator) {return $generator->randomNumber(2500, 70000);},
                'signed' => function() use ($generator) {return $generator->dateTimeBetween(new \DateTime('01.01.2013'), new \DateTime('31.12.2013'));}
            ));

        $populator->execute();


        $this->generateAdminLogin($manager);
    }


    private function generateAdminLogin(ObjectManager $manager){
        $admin = new Employee();
        $admin->setEmail('admin@hermes.com');
        $admin->setFirstName('John');
        $admin->setLastName('Doe');
        $admin->setPassword('admin');
        $admin->setOffice($manager->createQueryBuilder()->select('o')->from('Hermes\\ModelBundle\\Entity\\Office', 'o')->setMaxResults(1)->getQuery()->getSingleResult());

        $manager->persist($admin);
        $manager->flush();
    }


    private function loadCategories(ObjectManager $manager){
        $categories = array('First minute',
                            'Last minute',
                            'VIP',
                            'Akční nabídka',
                            'normal'
                     );

        $categoriesEntities = [];

        foreach($categories as $categoryName){
            $category = new Category();
            $category->setName($categoryName);

            $categoriesEntities[] = $category;
            $manager->persist($category);
        }
        $manager->flush();

        return $categoriesEntities;
    }

    private function loadTypes(ObjectManager $manager){
        $types = array('pobytové zájezdy',
                        'blízká moře',
                        'lyžařské zájezdy',
                        'poznávací zájezdy',
                        'exotika',
                        'lázeňské pobyty',
                        'eurovíkendy',
                        'chaty a chalupy',
                        'rekreační domy',
                        'hory a jezera',
                        'aktivní dovolená',
                        'plavby lodí',
                        'individuální turistika'
                  );

        $typesEntities = [];

        foreach($types as $typeName){
            $type = new Type();
            $type->setName($typeName);

            $typesEntities[] = $type;
            $manager->persist($type);
        }
        $manager->flush();

        return $typesEntities;
    }



    private function loadCountries(ObjectManager $manager)
    {

        $countries = array(
            'Afghanistan', 'Albania', 'Algeria', 'American Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antarctica (the territory South of 60 deg S)', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan',
            'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Bouvet Island (Bouvetoya)', 'Brazil', 'British Indian Ocean Territory (Chagos Archipelago)', 'British Virgin Islands', 'Brunei Darussalam', 'Bulgaria', 'Burkina Faso', 'Burundi',
            'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'China', 'Christmas Island', 'Cocos (Keeling) Islands', 'Colombia', 'Comoros', 'Congo', 'Cook Islands', 'Costa Rica', 'Cote d\'Ivoire', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic',
            'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic',
            'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia',
            'Faroe Islands', 'Falkland Islands (Malvinas)', 'Fiji', 'Finland', 'France', 'French Guiana', 'French Polynesia', 'French Southern Territories',
            'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guernsey', 'Guinea', 'Guinea-Bissau', 'Guyana',
            'Haiti', 'Heard Island and McDonald Islands', 'Holy See (Vatican City State)', 'Honduras', 'Hong Kong', 'Hungary',
            'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Isle of Man', 'Israel', 'Italy',
            'Jamaica', 'Japan', 'Jersey', 'Jordan',
            'Kazakhstan', 'Kenya', 'Kiribati', 'Korea', 'Korea', 'Kuwait', 'Kyrgyz Republic',
            'Lao People\'s Democratic Republic', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libyan Arab Jamahiriya', 'Liechtenstein', 'Lithuania', 'Luxembourg',
            'Macao', 'Macedonia', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Montserrat', 'Morocco', 'Mozambique', 'Myanmar',
            'Namibia', 'Nauru', 'Nepal', 'Netherlands Antilles', 'Netherlands', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Norway',
            'Oman',
            'Pakistan', 'Palau', 'Palestinian Territory', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn Islands', 'Poland', 'Portugal', 'Puerto Rico',
            'Qatar',
            'Reunion', 'Romania', 'Russian Federation', 'Rwanda',
            'Saint Barthelemy', 'Saint Helena', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Martin', 'Saint Pierre and Miquelon', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia (Slovak Republic)', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Georgia and the South Sandwich Islands', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Svalbard & Jan Mayen Islands', 'Swaziland', 'Sweden', 'Switzerland', 'Syrian Arab Republic',
            'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tokelau', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks and Caicos Islands', 'Tuvalu',
            'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States of America', 'United States Minor Outlying Islands', 'United States Virgin Islands', 'Uruguay', 'Uzbekistan',
            'Vanuatu', 'Venezuela', 'Vietnam',
            'Wallis and Futuna', 'Western Sahara',
            'Yemen',
            'Zambia', 'Zimbabwe'
        );

        $countryEntities = [];

        foreach($countries as $countryName){
            $country = new Country();
            $country->setName($countryName);

            $countryEntities[] = $country;
            $manager->persist($country);
        }
        $manager->flush();

        return $countryEntities;
    }

}


class CS_CZ_ADDRESS extends \Faker\Provider\Base
{

    private static $cities = array(
        'Praha', 'Brno', 'Olomouc', 'Chomutov', 'Ostrava', 'České Budějovice', 'Tábor', 'Ústí nad Labem', 'Most', 'Teplice', 'Liberec', 'Česká lípa', 'Pardubice', 'Hradec Králové', 'Kolín',
        'Karlovy Vary', 'Cheb', 'Plzeň', 'Benešov', 'Moravská Třebová'
    );

    public function getCity(){
        return self::$cities[$this->generator->randomNumber(0, count(self::$cities) - 1)];
    }


}