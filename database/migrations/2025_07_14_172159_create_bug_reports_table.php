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
        Schema::create("bug_reports", function (Blueprint $table) {
            $table->id();
            $table->foreignId("project_id")->constrained("bug_bounty_projects")->cascadeOnDelete();
            $table->foreignId("researcher_id")->constrained("researchers")->cascadeOnDelete();
            $table->string("title");
            $table->text("description");
            // wartosci raczej niezmienne wiec enum w bazie
            $table->enum("severity", ["low", "medium", "high"])->default("low");
            $table->string("status")->default("open"); // open, in_progress, closed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("bug_reports");
    }
};
