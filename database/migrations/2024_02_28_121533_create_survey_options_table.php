    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('survey_options', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('question_id');
                $table->foreign('question_id')->references('id')->on('survey_questions')->onDelete('cascade');
                $table->string('option');
                $table->timestamps();

                $table->index('question_id');

            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('survey_options');
        }
    };
