<?php

	use Core\Test\TestCase;
	use Core\Models\Account\AccountModel;
	use Core\Models\Address\AddressModel;
	use Core\Models\Avatar\AvatarModel;
	use Core\Models\Telephone\TelephoneModel;
	use Core\Models\Email\EmailModel;

	class AccountModelTest extends TestCase
	{
		public function setUp()
		{
			parent::setUp();

			$this->createSchema();

			//Persist needeed data in db
			
			//Add SP state
			$state = new Core\Models\Address\State\StateModel();
			$state->setId(26); //SP
			$state->setInitials('SP');
			$state->setState('Sao Paulo');

			//http://stackoverflow.com/questions/32784033/symfony2-doctrine2-autoincrement-field-with-custom-id-generator
			$metadata = $this->entityManager->getClassMetadata(get_class($state));
         	$metadata->setIdGeneratorType($metadata::GENERATOR_TYPE_NONE);

			$this->entityManager->persist($state);

			//Add Sao Paulo city
			$city = new Core\Models\Address\City\CityModel();
			$city->setId(9422);
			$city->setCity('Sao Paulo');
			$city->setState($state);

			$metadata = $this->entityManager->getClassMetadata(get_class($city));
         	$metadata->setIdGeneratorType($metadata::GENERATOR_TYPE_NONE);

			$this->entityManager->persist($city);

			//Persist and save the entities
			$this->entityManager->flush();
		}

		public function tearDown()
		{
			parent::tearDown();

			$this->dropSchema();
		}

		/**
		 * Should instantiate a AccountModel and return a object
		 * 
		 * @return object $account
		 */
		public function testAccountModel()
		{
			$account = new AccountModel();

			$this->assertInternalType('object', $account, '$account is not a object.');
		}

		/**
		 * Should persist a AccountModel
		 * 
		 * @return
		 */
		public function testPersistAccountModel()
		{
			//Account
			$account = new AccountModel();
			$account->setName($this->faker->name);
			$account->setLogin($this->faker->email);
			$account->setNickname($this->faker->name);
			$account->setPassword($this->faker->password);

			//Persist
			$this->entityManager->persist($account);
			$this->entityManager->flush();

			echo "==== Persisting Account ====\n";
			echo "Name -> {$account->getName()}\n";
			echo "Login -> {$account->getLogin()}\n";
			echo "Password -> {$account->getPassword()}\n";

			$this->assertInternalType('integer', $account->getId(), 'Account has not been saved.');
		}
		
		/**
		 * Should persist a AccountModel with
		 * - Address
		 * - Avatar
		 * - Telephone
		 * - Email
		 * 
		 * @return
		 */
		public function testPersistAccountModelWithRelationships()
		{
			//Account
			$account = new AccountModel();
			$account->setName($this->faker->name);
			$account->setLogin($this->faker->email);
			$account->setNickname($this->faker->name);
			$account->setPassword($this->faker->password);
			$this->entityManager->persist($account);

			//Address
			$cep = $this->faker->postcode;
			$patio = $this->faker->streetName;
			$number = $this->faker->buildingNumber;
			$complement = 'Street';
			$neighborhood = $this->faker->citySuffix;
			$state = $this->getEntityCore('Address\State\StateModel')->get(26); //SP
			$city = $this->getEntityCore('Address\City\CityModel')->get(9422); //Sao Paulo;

			$address = new AddressModel();
			$address->setCep($cep);
			$address->setPatio($patio);
			$address->setNumber($number);
			$address->setComplement($complement);
			$address->setNeighborhood($neighborhood);
			$address->setState($state);
			$address->setCity($city);
			$address->setAccount($account);
			$this->entityManager->persist($address);

			//Avatar
			$descAvatar = 'avatar.png';
			$thumbnail = 'avatar-thumbnail.png';
			$avatar = new AvatarModel;
			$avatar->setAvatar($descAvatar);
			$avatar->setThumbnail($thumbnail);
			$avatar->setAccount($account);
			$this->entityManager->persist($avatar);

			//Telephone
			$descTelephone = $this->faker->phoneNumber;
			$telephone = new TelephoneModel();
			$telephone->setTelephone($descTelephone);
			$telephone->setAccount($account);
			$this->entityManager->persist($telephone);

			//Email
			$descEmail = $this->faker->email;
			$email = new EmailModel();
			$email->setEmail($descEmail);
			$email->setAccount($account);
			$this->entityManager->persist($email);

			//Persist
			$this->entityManager->flush();

			//The changes are not present in the object, so, we refresh it
			$this->entityManager->refresh($account);

			echo "==== Persisting... ====\n";

			echo "Account... ====\n";
			echo "Name -> {$account->getName()}\n";
			echo "Login -> {$account->getLogin()}\n";
			echo "Password -> {$account->getPassword()}\n";
			
			echo "-----------------------\n";

			echo "Address... ====\n";
			echo "CEP -> {$account->getAddress()[0]->getCep()}\n";
			echo "Patio -> {$account->getAddress()[0]->getPatio()}\n";
			echo "Number -> {$account->getAddress()[0]->getNumber()}\n";
			echo "Complement -> {$account->getAddress()[0]->getComplement()}\n";
			echo "Neighborhood -> {$account->getAddress()[0]->getNeighborhood()}\n";
			echo "State -> {$account->getAddress()[0]->getState()->getState()}\n";
			echo "City -> {$account->getAddress()[0]->getCity()->getCity()}\n";

			echo "-----------------------\n";

			echo "Avatar... ====\n";
			echo "Avatar -> {$account->getAvatar()->getAvatar()}\n";
			echo "Thumbnail -> {$account->getAvatar()->getThumbnail()}\n";

			echo "-----------------------\n";

			echo "Telephone... ====\n";
			echo "Telephone -> {$account->getTelephones()[0]->getTelephone()}\n";

			echo "-----------------------\n";

			echo "Email... ====\n";
			echo "Email -> {$account->getEmails()[0]->getEmail()}\n";

			echo "-----------------------\n";

			echo "Done.\n";

			//Account
			$this->assertInternalType('integer', $account->getId(), 'The account has not been saved.');

			//Address
			$this->assertInternalType('integer', $account->getAddress()[0]->getId(), 'Address has not been saved.');

			//Avatar
			$this->assertInternalType('integer', $account->getAvatar()->getId(), 'Avatar has not been saved.');

			//Telephone
			$this->assertInternalType('integer', $account->getTelephones()[0]->getId(), 'Telephone has not been saved.');

			//E-mail
			$this->assertInternalType('integer', $account->getEmails()[0]->getId(), 'E-mail has not been saved.');
		}
	}