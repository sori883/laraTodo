<?php

namespace Tests\Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProjectRequest;
use Tests\TestCase;

class ProjectRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider dataproviderProjectForm
     */
    public function testProjectLoginValidation($data, $expect)
    {
        $rules = (new ProjectRequest())->rules();
        $validator = Validator::make($data, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataproviderProjectForm()
    {
        return [
            [
                '正常' => [
                    'title' => str_repeat('a', 20)
                ], true,
            ],
            [
                '必須エラー' => [
                    'title' => ''
                ], false,
            ],
            [
                '文字数エラー' => [
                    'title' => str_repeat('a', 21)
                ], false
            ]
        ];
    }
}
