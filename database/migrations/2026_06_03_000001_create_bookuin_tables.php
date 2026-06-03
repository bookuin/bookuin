<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->year('year')->nullable();
            $table->decimal('price', 14, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->string('cover')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('book_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('quantity');
            $table->string('supplier')->nullable();
            $table->text('note')->nullable();
            $table->date('entry_date');
            $table->timestamps();
        });

        Schema::create('book_exits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('quantity');
            $table->string('destination')->nullable();
            $table->text('note')->nullable();
            $table->date('exit_date');
            $table->timestamps();
        });

        Schema::create('shipping_costs', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('courier')->default('Reguler');
            $table->decimal('cost', 14, 2)->default(0);
            $table->string('estimated_days')->nullable();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shipping_cost_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_code')->unique();
            $table->decimal('subtotal', 14, 2)->default(0);
            $table->decimal('shipping_cost', 14, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
            $table->enum('payment_status', ['unpaid','pending','paid','failed','expired','cancelled'])->default('unpaid');
            $table->enum('order_status', ['waiting_payment','paid','processed','shipped','completed','cancelled'])->default('waiting_payment');
            $table->string('midtrans_order_id')->nullable()->index();
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('price', 14, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('payment_type')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('fraud_status')->nullable();
            $table->json('raw_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('shipping_costs');
        Schema::dropIfExists('book_exits');
        Schema::dropIfExists('book_entries');
        Schema::dropIfExists('books');
        Schema::dropIfExists('categories');
    }
};
