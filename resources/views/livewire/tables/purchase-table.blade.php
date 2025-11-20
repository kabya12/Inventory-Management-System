<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to open the payment modal
            function openPaymentModal(purchaseId) {
                $('#purchaseIdInput_' + purchaseId).val(purchaseId);
                $('#exampleModal_' + purchaseId).modal('show');
            }

            // Bind event to show modal
            $('body').on('show.bs.modal', '[id^=exampleModal_]', function(event) {
                var modal = $(this);
                var purchaseId = modal.attr('id').split('_')[1];
                var modalTotalAmount = $('#modalTotalAmount_' + purchaseId).text().trim();
                var modalPayingAmount = $('#payingAmount_' + purchaseId).val().trim(); // Get the paying amount from the input field
                $('#receivedAmount_' + purchaseId).val(modalTotalAmount);
                $('#payingAmount_' + purchaseId).val(modalPayingAmount); // Update the paying amount field with the existing value
            });

            // Function to handle saving changes in the modal
            $('body').on('click', '[id^=saveChangesBtnModal_]', function() {
                var purchaseId = $(this).attr('id').split('_')[1];
                var payingAmount = $('#payingAmount_' + purchaseId).val();

                // Make an AJAX request to update the paying amount
                $.ajax({
                    url: '/update-paying-amount/' + purchaseId,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        paying_amount: payingAmount
                    },
                    success: function(response) {
                        console.log('Paying amount updated successfully:', response);
                        // Optionally, you can update the UI to reflect the changes
                    },
                    error: function(xhr) {
                        console.error('Error updating paying amount:', xhr.responseText);
                    }
                });
            });

            // Call function to calculate grand total initially
            // Assuming you have a function called setGrandTotal() defined elsewhere
            setGrandTotal();
        });
    </script>
</head>

<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Purchases') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('purchases.create') }}" />
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Show
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                entries
            </div>
            <div class="ms-auto text-secondary">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm"
                        aria-label="Search invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner />

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle text-center w-1">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('purchase_no')" href="#" role="button">
                            {{ __('Purchase No.') }}
                            @include('inclues._sort-icon', ['field' => 'purchase_no'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('supplier_id')" href="#" role="button">
                            {{ __('Supplier') }}
                            @include('inclues._sort-icon', ['field' => 'supplier_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            {{ __('Date') }}
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('total_amount')" href="#" role="button">
                            {{ __('Grand Total') }}
                            @include('inclues._sort-icon', ['field' => 'total_amount'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('paying_amount')" href="#" role="button">
                            {{ __('Paid') }}
                            @include('inclues._sort-icon', ['field' => 'paying_amount'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('')" href="#" role="button">
                            {{ __('Due') }}
                            @include('inclues._sort-icon', ['field' => 'due'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('status')" href="#" role="button">
                            {{ __('Status') }}
                            @include('inclues._sort-icon', ['field' => 'status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchases as $purchase)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $purchase->purchase_no }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $purchase->supplier->name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $purchase->date->format('d-m-Y') }}
                        </td>
                        <td class="align-middle text-center total-amount" id="modalTotalAmount_{{ $purchase->id }}">
                            ₹{{ number_format($purchase->total_amount, 2) }}
                        </td>
                        <td class="align-middle text-center">
                            @if ($purchase->paying_amount !== null)
                                ₹{{ number_format($purchase->paying_amount, 2) }}
                            @else
                                --
                            @endif
                        </td>
                        <td class="align-middle text-center">
                            <!-- Due amount -->
                        </td>

                        @if ($purchase->status === \App\Enums\PurchaseStatus::APPROVED)
                            <td class="align-middle text-center">
                                <span class="badge bg-green text-white text-uppercase">
                                    {{ __('APPROVED') }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <x-button.show class="btn-icon"
                                    route="{{ route('purchases.edit', $purchase->uuid) }}" />
                            </td>
                        @else
                            <td class="align-middle text-center">
                                <span class="badge bg-orange text-white text-uppercase">
                                    {{ __('PENDING') }}
                                </span>
                            </td>
                            <td class="align-middle text-center" style="width: 10%">
                                <x-button.show class="btn-icon"
                                    route="{{ route('purchases.edit', $purchase->uuid) }}" />

                                <x-button class="btn-icon" onclick="openPaymentModal({{ $purchase->id }})"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $purchase->id }}"
                                    data-toggle="tooltip" title="Add Payment">
                                    <i class="fas fa-money-bill"></i>
                                </x-button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal_{{ $purchase->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" id="purchaseIdInput_{{ $purchase->id }}">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="receivedAmount" class="form-label">Total
                                                            Amount</label>
                                                        <input type="text" class="form-control"
                                                            id="receivedAmount_{{ $purchase->id }}"
                                                            placeholder="Total Amount" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="payingAmount" class="form-label">Paying
                                                            Amount</label>
                                                        <input type="number" class="form-control"
                                                            id="payingAmount_{{ $purchase->id }}"
                                                            placeholder="Enter Paying Amount">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="change" class="form-label">Change</label>
                                                        <p id="changeValue">₹0.00</p>
                                                    </div>
                                                    <div class="col">
                                                        <label for="paidBy" class="form-label">Paid By</label>
                                                        <input type="text" class="form-control" id="paidBy"
                                                            placeholder="Enter Paid By">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="paymentNote" class="form-label">Payment
                                                            Note</label>
                                                        <textarea class="form-control" id="paymentNote" rows="3" placeholder="Enter Payment Note"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" id="saveChangesBtnModal_{{ $purchase->id }}"
                                                    class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-button.complete class="btn-icon"
                                    onclick="return confirm('Are you sure to approve purchase no. {{ $purchase->purchase_no }}!') route="{{ route('purchases.update', $purchase->uuid) }}" />
                                <x-button.complete class="btn-icon"
                                    route="{{ route('purchases.update', $purchase->uuid) }}"
                                    onclick="return confirm('Are you sure to approve purchase no. {{ $purchase->purchase_no }}?')" />
                                <x-button.delete class="btn-icon" onclick="return confirm('Are you sure!')"
                                    route="{{ route('purchases.delete', $purchase->uuid) }}" />
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="7">
                            No results found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $purchases->firstItem() }}</span> to <span>{{ $purchases->lastItem() }}</span> out of
            <span>{{ $purchases->total() }}</span> entries
        </p>
        <div class="ms-auto">
            {{ $purchases->links() }}
        </div>
    </div>
</div>
