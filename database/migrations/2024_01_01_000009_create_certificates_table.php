<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issuing_organization');
            $table->year('year');
            $table->string('certificate_image')->nullable();
            $table->text('description')->nullable();
            $table->string('credential_url')->nullable();
            $table->string('category')->nullable(); // e.g., Teaching, Leadership, Digital
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('certificates'); }
};
