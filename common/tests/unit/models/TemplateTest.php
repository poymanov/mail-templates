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
        $model = $this->makeTemplate();

        $model->saveContentToFile();

        $this->assertTrue(is_file($model->getContentPath()));

        unlink($model->getContentPath());
    }

    public function testGetContentFromFile()
    {
        $content = 'test content 2';
        $model = $this->makeTemplate();
        $model->content = $content;

        $model->saveContentToFile();
        $model->content = null;

        $model->getContentFromFile();

        $this->assertEquals($content, $model->content);

        unlink($model->getContentPath());
    }

    public function testDeleteContentFile()
    {
        $model = $this->makeTemplate();
        $model->saveContentToFile();
        $model->deleteContentFile();

        $this->assertFalse(is_file($model->getContentPath()));
    }

    public function testCreateTemplate()
    {
        $model = $this->makeTemplate();

        $model->save();

        $this->assertTrue(is_file($model->getContentPath()));
        unlink($model->getContentPath());
    }

    public function testDeleteTemplate()
    {
        $model = $this->makeTemplate();

        $contentPath = $model->getContentPath();

        $model->save();
        $model->delete();

        $this->assertFalse(is_file($contentPath));
    }

    private function makeTemplate()
    {
        $filename = 'test' . time() . '.html';
        $content = 'test content';
        $title = 'test';

        $model = new Template([
            'title' => $title,
            'filename' => $filename,
            'content' => $content,
        ]);

        return $model;
    }
}