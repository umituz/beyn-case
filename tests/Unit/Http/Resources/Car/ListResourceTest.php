<?php

namespace Tests\Unit\Http\Resources\Newsletter;

use App\Http\Resources\Newsletter\ListResource;
use App\Http\Resources\Newsletter\ListResourceCollection;
use App\Models\CampaignBuilder;
use App\Models\NewsletterSetting;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\Suites\ResourceTestSuite;

/**
 * Class ListResourceTest
 * @package Tests\Unit\Http\Resources\Newsletter
 * @coversDefaultClass \App\Http\Resources\Newsletter\ListResource
 */
class ListResourceTest extends ResourceTestSuite
{
    use WithFaker;

    const DATE_FORMAT = 'Y-m-d';

    /**
     * @test
     * @covers ::collection
     */
    public function it_should_return_list_resource_collection()
    {
        /** @var ListResource|MockObject $listResourceMock */
        $listResourceMock = $this->getIsolatedMock(ListResource::class);

        $this->assertInstanceOf(ListResourceCollection::class, ListResource::collection($listResourceMock));
    }

    /**
     * @test
     * @covers ::injectAdditionalDependencies
     */
    public function it_should_returned_instance()
    {
        $timeZone = $this->faker->timezone;

        /** @var ListResource|MockObject $listResourceMock */
        $listResourceMock = $this->createMock(ListResource::class);

        $this->assertInstanceOf(ListResource::class, $listResourceMock->injectAdditionalDependencies($timeZone));
    }

    /**
     * @test
     * @covers ::toArray
     */
    public function it_should_return_to_array()
    {
        Carbon::setTestNow(Carbon::now()->midDay());

        $builder = factory(CampaignBuilder::class)->make();
        $settings = factory(NewsletterSetting::class)->make([
            'campaignBuilder' => $builder->id,
            'status' => 1,
            'sentDate' => Carbon::now(),
            'scheduleDate' => null,
        ]);

        $settings->translation = 'test';
        $builder->newsletterSetting = $settings;
        $expectedData = [
            'campName' => $builder->campName,
            'deviceTypeSegmentEnabled' => $builder->deviceTypeSegmentEnabled,
            'id' => $builder->id,
            'isPinned' => $builder->isPinned,
            'newsletter_setting' => $settings,
            'productName' => $builder->productName,
            'sentDate' => Carbon::now()->setTimezone('UTC')->format(self::DATE_FORMAT),
            'sendDate' => Carbon::now()->setTimezone('UTC')->format(self::DATE_FORMAT),
            'scheduleDate' => Carbon::now()->setTimezone('UTC')->format(self::DATE_FORMAT),
            'tags' => $builder->tags,
            'statusTranslation' => $settings->status_translation,
            'status' => $settings->status_label,
            'typeTranslation' => 'newsletter.experiment',
            'type' => $settings->label,
            'createDate' => $builder->createDate,
        ];
        $listResource = $this->getMockBuilder(ListResource::class)
            ->setConstructorArgs([$builder])
            ->onlyMethods([])
            ->getMock();

        $this->assertEquals($expectedData, ($listResource)->resolve());
    }

    /**
     * @test
     * @covers ::toArray
     */
    public function it_should_return_to_array_with_sent_date_as_null()
    {
        Carbon::setTestNow(Carbon::now()->midDay());

        $builder = factory(CampaignBuilder::class)->make();
        $settings = factory(NewsletterSetting::class)->make([
            'campaignBuilder' => $builder->id,
            'status' => 1,
            'sentDate' => null,
            'scheduleDate' => null,
            'recurrence' => null,
        ]);

        $settings->translation = 'test';
        $builder->newsletterSetting = $settings;
        $expectedData = [
            'campName' => $builder->campName,
            'deviceTypeSegmentEnabled' => $builder->deviceTypeSegmentEnabled,
            'id' => $builder->id,
            'isPinned' => $builder->isPinned,
            'newsletter_setting' => $settings,
            'productName' => $builder->productName,
            'sentDate' => null,
            'sendDate' => null,
            'scheduleDate' => null,
            'tags' => $builder->tags,
            'statusTranslation' => $settings->status_translation,
            'status' => $settings->status_label,
            'typeTranslation' => 'newsletter.experiment',
            'type' => $settings->label,
            'createDate' => $builder->createDate,
        ];

        /** @var ListResource|MockObject $listResource */
        $listResource = $this->getMockBuilder(ListResource::class)
            ->setConstructorArgs([$builder])
            ->onlyMethods([])
            ->getMock();

        $this->assertEquals($expectedData, ($listResource)->resolve());
    }

    /**
     * @test
     * @covers ::toArray
     */
    public function it_should_return_to_array_with_send_date_as_empty_string()
    {
        Carbon::setTestNow(Carbon::now()->midDay());

        $builder = factory(CampaignBuilder::class)->make();
        $settings = factory(NewsletterSetting::class)->make([
            'campaignBuilder' => $builder->id,
            'status' => 2,
            'sentDate' => null,
            'scheduleDate' => null,
            'recurrence' => null,
        ]);

        $settings->translation = 'test';
        $builder->newsletterSetting = $settings;
        $expectedData = [
            'campName' => $builder->campName,
            'deviceTypeSegmentEnabled' => $builder->deviceTypeSegmentEnabled,
            'id' => $builder->id,
            'isPinned' => $builder->isPinned,
            'newsletter_setting' => $settings,
            'productName' => $builder->productName,
            'sentDate' => null,
            'sendDate' => '',
            'scheduleDate' => null,
            'tags' => $builder->tags,
            'statusTranslation' => $settings->status_translation,
            'status' => $settings->status_label,
            'typeTranslation' => 'newsletter.experiment',
            'type' => $settings->label,
            'createDate' => $builder->createDate,
        ];

        /** @var ListResource|MockObject $listResource */
        $listResource = $this->getMockBuilder(ListResource::class)
            ->setConstructorArgs([$builder])
            ->onlyMethods([])
            ->getMock();

        $this->assertEquals($expectedData, ($listResource)->resolve());
    }
}
