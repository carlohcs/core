<?php

	use Carlohcs\Core\Test\TestCase;
	use Carlohcs\Core\Models\Account\AccountModel;

	class AccountModelTest extends TestCase
	{
		public function setUp()
		{
			parent::setUp();

			$this->createSchema();
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
			$name = $this->faker->name;
			$login = $this->faker->email;
			$password = $this->faker->password;

			$accountModel = new AccountModel();
			$accountModel->setName($name);
			$accountModel->setLogin($login);
			$accountModel->setNickname($name);
			$accountModel->setPassword($password);

			//Persist
			$this->entityManager->persist($accountModel);
			$this->entityManager->flush();

			echo "==== Persist Admin Account Test ====\n";
			echo "Name -> {$name}\n";
			echo "Login -> {$login}\n";
			echo "Password -> {$password}\n";

			$this->assertInternalType('integer', $accountModel->getId(), 'The admin account has not been saved.');
		}
	}