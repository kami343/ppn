<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->comment('Id from cities table');
            $table->enum('is_home_page', ['N','Y'])->default('N')->comment('N=>No, Y=>Yes');
            $table->string('page_name')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('short_title')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description2')->nullable();
            $table->longText('other_description')->nullable();
            $table->text('banner_title')->nullable();
            $table->text('banner_short_title')->nullable();
            $table->text('banner_short_description')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('banner_image_title')->nullable();
            $table->string('banner_image_alt')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_title')->nullable();
            $table->string('featured_image_alt')->nullable();
            $table->string('other_image')->nullable();
            $table->string('other_image_title')->nullable();
            $table->string('other_image_alt')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->enum('status', ['0','1'])->default('1')->comment('0=>Inactive, 1=>Active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms');
    }
}
