<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->text('description');
            $table->enum('type_transaction', ['location', 'vente']);
            $table->enum('categorie', ['maison', 'appartement', 'terrain', 'boutique', 'autre']);
            $table->string('ville');
            $table->string('quartier')->nullable();
            $table->decimal('prix', 12, 2);
            $table->integer('superficie')->nullable(); // en m²
            $table->integer('nb_chambres')->nullable();
            $table->integer('nb_salles_bain')->nullable();
            $table->string('telephone_contact');
            $table->boolean('est_boostee')->default(false);
            $table->timestamp('boost_expire_le')->nullable();
            $table->enum('statut', ['active', 'vendue', 'louee', 'suspendue'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
