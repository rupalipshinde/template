<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Rupalipshinde\Template\TemplateModel;

class CreateEmailTemplatesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subject');
            $table->text('description');
            $table->string('language', 5)->default('en');
            $table->text('placeholder')->nullable();
            $table->string('event')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
            $table->timestamps();
            $table->softDeletes();
        });

        $emailTemplates = array(
            array('id' => '1',
                'title' => 'Notification to Simplex Admin for Password Reset (Forgot Password)',
                'subject' => 'Reset your password',
                'description' => 'Hello {!! SUPER_ADMIN_FIRST_NAME !!} {!! SUPER_ADMIN_LAST_NAME !}},

                We recently received a request to reset your {!! PORTAL_NAME !!} password.

                Click here to change your password. 

                {!! PASSWORD_RESET_URL !!}                              

                Account URL: {!! PORTAL_ADDRESS !!}

                Thanks,

                [PORTAL_NAME] Team', 
                'language' => 'en', 
                'placeholder' => 'SUPER_ADMIN_FIRST_NAME,SUPER_ADMIN_LAST_NAME,PORTAL_NAME,PASSWORD_RESET_URL,PORTAL_ADDRESS,PORTAL_NAME',
                'event' => 'forgot_password', 
                'status' => '1'),
        );
        TemplateModel::insert($emailTemplates);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('email_templates');
    }

}
