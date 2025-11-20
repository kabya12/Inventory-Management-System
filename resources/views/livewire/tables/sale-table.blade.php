<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function() {
            // Function to calculate grand total
            function setGrandTotal() {
                var grandTotal = 0;

                $('.table tbody tr').each(function() {
                    var totalAmountText = $(this).find('.align-middle.text-center.total-amount').text()
                        .trim();
                    var totalAmount = parseFloat(totalAmountText.replace('₹', '').replace(',', ''));
                    grandTotal += totalAmount;
                });

                $('#receivedAmount').val('₹' + grandTotal.toFixed(2));
            }

            // Bind event to show modal
            $('#exampleModal').on('show.bs.modal', function(event) {
                var modal = $(this);
                var button = $(event.relatedTarget); // Button that triggered the modal
                var purchaseId = button.data('purchase-id'); // Extract purchase ID from data-* attributes
                var modalTotalAmount = $('#modalTotalAmount_' + purchaseId).text().trim();
                $('#receivedAmount').val(modalTotalAmount);
            });
        });
    </script>
</head>

<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Sales') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('sale.create') }}" />
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
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            {{ __('Date') }}
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('biller')" href="#" role="button">
                            {{ __('Biller') }}
                            @include('inclues._sort-icon', ['field' => 'biller'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('customer')" href="#" role="button">
                            {{ __('Customer') }}
                            @include('inclues._sort-icon', ['field' => 'customer'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('sale_status')" href="#" role="button">
                            {{ __('Sale Status') }}
                            @include('inclues._sort-icon', ['field' => 'sale_status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('payment_status')" href="#" role="button">
                            {{ __('Payment Status') }}
                            @include('inclues._sort-icon', ['field' => 'payment_status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('delivery_status')" href="#" role="button">
                            {{ __('Delivery Status') }}
                            @include('inclues._sort-icon', ['field' => 'delivery_status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('total_amount')" href="#" role="button">
                            {{ __('Grand Total') }}
                            @include('inclues._sort-icon', ['field' => 'total_amount'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('returned_amount')" href="#" role="button">
                            {{ __('returned_amount') }}
                            @include('inclues._sort-icon', ['field' => 'returned_amount'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('paid')" href="#" role="button">
                            {{ __('Paid') }}
                            @include('inclues._sort-icon', ['field' => 'paid'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('due')" href="#" role="button">
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
                            {{ $purchase->date->format('d-m-Y') }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $purchase->supplier->name }}
                        </td>
                        <td class="align-middle text-center">

                        </td>
                        <td></td>
                        <td class="align-middle text-center total-amount" id="modalTotalAmount_{{ $purchase->id }}">

                        </td>

                        <td class="align-middle text-center">

                        </td>
                        <td class="align-middle text-center">

                        </td>
                        <td class="align-middle text-center">

                        </td>
                        <td class="align-middle text-center">

                        </td>
                        <td class="align-middle text-center">

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

                                <x-button class="btn-icon" onclick="openPaymentModal()" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-toggle="tooltip" title="Add Payment"
                                    data-purchase-id="{{ $purchase->id }}">
                                    <i class="fas fa-money-bill"></i>
                                </x-button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="receivedAmount" class="form-label">Total
                                                            Amount</label>
                                                        <input type="text" class="form-control"
                                                            id="receivedAmount" placeholder="Total Amount" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label for="payingAmount" class="form-label">Paying
                                                            Amount</label>
                                                        <input type="text" class="form-control" id="payingAmount"
                                                            placeholder="Enter Paying Amount">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="change" class="form-label">Change</label>
                                                        <input type="text" class="form-control" id="change"
                                                            placeholder="Enter Change" readonly>
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
                                                <button type="button" class="btn btn-primary">Save changes</button>
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

        <div id="paymentModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Add Payment Form</p>
                <!-- Add your payment form content here -->
            </div>
        </div>
    </div>


    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $purchases->firstItem() }}</span>
            to <span>{{ $purchases->lastItem() }}</span> of <span>{{ $purchases->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $purchases->links() }}
        </ul>
    </div>
</div>
