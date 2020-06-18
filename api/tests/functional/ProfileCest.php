<?php

namespace api\tests\functional;

use api\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class ProfileCest
 */
class ProfileCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function access(FunctionalTester $I)
    {
        $I->sendGET('/v1/user', ['id' => 1]);
        $I->seeResponseCodeIs(401);
    }

    public function authenticated(FunctionalTester $I)
    {
        $I->amBearerAuthenticated('tUu1qHcde0diwUol3xeI-18MuHkkprQI');
        $I->sendGET('/v1/user', ['id' => 1]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'id' => 1,
            'username' => 'erau',
            'email' => 'sfriesen@jenkins.info',
        ]);
    }
}
