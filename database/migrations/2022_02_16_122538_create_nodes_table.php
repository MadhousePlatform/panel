<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Maximum length of a path on Linux.
     */
    private const MAX_UNIX_PATH_LENGTH = 2048;

    /**
     * Maximum length of a path on Windows.
     */
    private const MAX_WINNT_PATH_LENGTH = 260;

    /**
     * Maximum length of a path on MacOS.
     */
    private const MAX_MACOS_PATH_LENGTH = 1024;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(User::class)->onUpdate('cascade')->onDelete('restrict');
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();

            // Basic
            $table->string('location');
            $table->string('ip_address');
            $table->string('domain_name');
            $table->boolean('ssl')->default(true);
            $table->boolean('proxy')->default(false);

            // Config
            $table->string('file_dir', $this->getMaxPathLength());
            $table->unsignedBigInteger('total_memory');
            $table->decimal('memory_overallocation_amount')->default(0);
            $table->unsignedBigInteger('total_disk_space');
            $table->decimal('disk_overallocation_amount')->default(0);
            $table->integer('daemon_port');
            $table->integer('daemon_sftp_port');

            $table->longText('tags')->nullable();
            $table->boolean('locked')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    private function getMaxPathLength(): int
    {
        return match (PHP_OS_FAMILY) {
            'Darwin', 'Solaris', 'BSD' => self::MAX_MACOS_PATH_LENGTH,
            'Windows' => self::MAX_WINNT_PATH_LENGTH,
            default => self::MAX_UNIX_PATH_LENGTH,
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
    }
};
