<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovativo - Ordem {{$pagamento->id}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        /* A4 size in portrait: 210mm x 297mm */
        @media print {
            @page {
                size: A4;
                margin: 0;
                /* Remove default margins */
            }

            .no-print {
                display: none;
            }

            body {
                margin: 0;
                padding: 0;
                height: 297mm;
                /* A4 height */
                width: 210mm;
                /* A4 width */
                overflow: hidden;
            }

            .min-h-screen {
                min-height: auto;
                height: 297mm;
                /* Fixed to A4 height */
                width: 210mm;
                margin: 0 auto;
                padding: 0;
                display: block;
            }

            .invoice-box {
                box-shadow: none;
                border: 1px solid #e5e7eb;
                height: 287mm;
                /* Slightly less than A4 to account for border/padding */
                width: 200mm;
                /* Slightly less for padding */
                padding: 5mm;
                /* Reduced padding */
                margin: 0 auto;
                overflow: hidden;
                /* Prevent overflow */
                font-size: 12px;
                /* Base font size for compactness */
            }

            /* Compact layout */
            .invoice-box * {
                margin-bottom: 0.2rem !important;
                line-height: 1.1 !important;
            }

            .text-3xl {
                font-size: 1.25rem !important;
            }

            .text-xl {
                font-size: 1rem !important;
            }

            .text-lg {
                font-size: 0.875rem !important;
            }

            table {
                font-size: 0.75rem !important;
            }

            th,
            td {
                padding: 0.2rem 0.5rem !important;
            }

            .mt-6 {
                margin-top: 0.5rem !important;
            }

            .pb-6 {
                padding-bottom: 0.5rem !important;
            }
        }

        /* Screen styles remain unchanged */
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Container -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full space-y-8" x-data="invoiceData()">
            <!-- Invoice Box -->
            <div class="invoice-box bg-white p-8 rounded-xl shadow-lg">
                <!-- Header -->
                 <img class="animation__shake" src="../kanongue.png" alt="AdminLTELogo" style="
                        width: 150px;
                        height: 150px;">
                <div class="flex justify-between items-center border-b pb-6 mt-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Comprovativo</h1>
                        <p class="text-gray-600 mt-2">Comprovativo - Ordem {{$pagamento->id}}</span></p>
                    </div>
                    <div class="text-right">
                        <h2 class="text-xl font-semibold text-gray-900">Colégio Canongue</h2>
                        <p class="text-gray-600">canongue@teste.com</p>
                        <p class="text-gray-600">Enedereço luanda angola</p>
                    </div>
                </div>

                <!-- Billing Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Dados do aluno</h3>
                        <p class="text-gray-600" >{{$pagamento->aluno->nome ?? ''}}</p>
                        <p class="text-gray-600">{{$pagamento->aluno->clace->nome ?? ''}}</p>
                        <p class="text-gray-600">{{$pagamento->aluno->turma->nome ?? ''}}</span></p>
                        <p class="text-gray-600">Postal Code: <span x-text="customer.postalCode"></span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-600">Invoice Date: <span x-text="9988777"></span></p>
                        <p class="text-gray-600">Transaction Date: <span x-text="nif"></span></p>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mt-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 font-semibold text-gray-900">Descrição</th>
                                    <th class="py-2 px-4 font-semibold text-gray-900">Quantidade</th>
                                    <th class="py-2 px-4 font-semibold text-gray-900">Meses</th>
                                     <th class="py-2 px-4 font-semibold text-gray-900">Preço</th>
                                    <th class="py-2 px-4 font-semibold text სgray-900 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{$pagamento->desci?? ''}}</td>
                                    <td class="py-2 px-4">{{$pagamento->qnt ??''}}</td>
                                    <td class="py-2 px-4">
                                        @forelse ($pagamento->meses as $mes)
                                            {{$mes->nome}}
                                        @empty
                                        @endforelse
                                    </td>
                                    <td class="py-2 px-4"> {{number_format($pagamento->price, 2,',','.') ?? 0}} Kz</td>
                                    <td class="py-2 px-4 text-right"> {{$pagamento->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Totals -->
                <div class="mt-6 flex justify-end">
                    <div class="w-full md:w-1/3">
                        <div class="space-y-1">
                            <div class="flex justify-between font-semibold text-lg border-t pt-2">
                                <span>Total</span>
                                <span> {{number_format($pagamento->total, 2,',','.') }} Kz</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center text-gray-600">
                    <p>Obrigado por nos contactar!</p>
                    <p>Para qualquer dúvida este é nosso canal de suporte support@yourstore.com</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-center gap-4 no-print">
                <button @click="window.print()"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                    Print Invoice
                </button>
                <button @click="downloadPDF()"
                    class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 transition duration-300">
                    Download PDF
                </button>
            </div>
        </div>
    </div>

    <script>
        function invoiceData() {
            return {
                order: {
                    id: '250326Tanviryzu1038',
                    totalAmount: 364.00
                },
                customer: {
                    name: 'Tanvir Islam',
                    address: 'Dhaka, Jashore',
                    city: 'Jashore',
                    postalCode: '7420'
                },
                payment: {
                    transactionId: '8a4eb0b8e8',
                    amountPaid: 364.00,
                    cardType: 'NAGAD-Nagad',
                    status: 'VALID',
                    bankTransactionId: '25032714513xgFujK4vGnx8zDD',
                    transactionDate: '2025-03-27 01:45:13'
                },
                invoiceDate: new Date().toLocaleDateString(),
                get subtotal() {
                    return this.order.totalAmount;
                },
                get tax() {
                    return 0; // No tax specified
                },
                get total() {
                    return this.subtotal + this.tax;
                },
                downloadPDF() {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
                    const invoiceElement = document.querySelector('.invoice-box');

                    html2canvas(invoiceElement, { scale: 2 }).then(canvas => {
                        const imgData = canvas.toDataURL('image/png');
                        const imgProps = doc.getImageProperties(imgData);
                        const pdfWidth = doc.internal.pageSize.getWidth();
                        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                        const pageHeight = doc.internal.pageSize.getHeight();

                        // Scale to fit one page
                        let height = pdfHeight;
                        if (pdfHeight > pageHeight) {
                            height = pageHeight;
                        }

                        doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, height);
                        doc.save(`invoice-${this.order.id}.pdf`);
                    });
                }
            }
        }
    </script>
</body>

</html>