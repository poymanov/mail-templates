<?php
namespace common\tests\unit\models;
use common\models\Template;
use Yii;
use common\models\LoginForm;

/**
 * Login form test
 */
class TemplateTest extends \Codeception\Test\Unit
{
    public function testGetContentPath()
    {
        $filename = 'test' . time() . 'html';

        $contentPath = Yii::getAlias('@common/storage/' . $filename);

        $model = new Template([
            'filename' => $filename,
            'content' => 'test content',
        ]);

        $this->assertEquals($contentPath, $model->getContentPath());
    }

    public function testSaveContentToFile()
    {
        $filename = 'test' . time();

        $model = new Template([
            'filename' => $filename,
            'content' => 'test content',
        ]);

        $model->saveContentToFile();

        $this->assertTrue(is_file($model->getContentPath()));

        unlink($model->getContentPath());
    }

    public function testGetContentFromFile()
    {
        $filename = 'test' . time();
        $content = 'test content';

        $model = new Template([
            'filename' => $filename,
            'content' => 'test content',
        ]);

        $model->saveContentToFile();
        $model->content = null;

        $model->getContentFromFile();

        $this->assertEquals($content, $model->content);

        unlink($model->getContentPath());
    }

}