<?php

namespace backend\tests\modules\shop\models;

use backend\tests\UnitTester;
use Codeception\Test\Unit;
use common\fixtures\TagFixture as TagFixture;
use common\modules\shop\models\backend\Tag;

class TagTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;


    protected function _before()
    {
        $this->tester->haveFixtures([
            'tag' => [
                'class' => TagFixture::class,
                'dataFile' => '@common/fixtures/data/tag.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    public function testCorrectCreateTag()
    {
        $model = new Tag([
            'name' => 'test-tag'
        ]);

        expect('model is saved', $model->save())->true();
        expect('Id is correct', $model->id)->notEmpty();
        expect('Name is correct', $model->name)->notEmpty();
    }

    public function testNotCorrectCreateTag()
    {
        $model = new Tag([
            'name' => ''
        ]);

        expect_not($model->save());
        expect_that($model->getErrors('name'));
        expect($model->getFirstError('name'))
            ->equals('Name cannot be blank.');
    }


}