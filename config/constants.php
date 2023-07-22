<?php

// array index is db value
// order of array is very important
return [
    "order_status" => [
        "Pending",
        "Confirmed",
        "Processing",
        "On the Way",
        "Completed",
        "On Hold",
        "Cancelled",
        "Refunded",
    ],
    "order_type" => [
        "Sales Quotation",
        "Sales Order",
        "Purchase Quotation",
        "Purchase Order",
    ],
    "order_source" => [
        "Ecommerce",
        "Physical"
    ],
    "payment_status" => [
        "Unpaid",
        "Paid",
        "Partially Paid",
    ],
    "buyer_type" => [
        "User",
        "Company"
    ],
    "product_status" => [
        "Draft",
        "In Review",
        "Published",
        "Rejected"
    ]
];

?>
