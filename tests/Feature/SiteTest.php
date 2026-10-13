<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_home_page_renders_for_a_known_host(): void
    {
        $this->get('http://androidpixels.localhost/')
            ->assertOk()
            ->assertSee('安卓像素');
    }

    public function test_each_site_only_shows_its_own_content(): void
    {
        $this->get('http://gplaytips.localhost/')
            ->assertOk()
            ->assertSee('Play 帮手')
            ->assertDontSee('谷歌服务安装');
    }

    public function test_article_page_renders(): void
    {
        $this->get('http://androidpixels.localhost/gms/huawei/')
            ->assertOk()
            ->assertSee('华为谷歌三件套安装教程');
    }

    public function test_unknown_host_is_rejected(): void
    {
        $this->get('http://nobody.localhost/')->assertNotFound();
    }
}
