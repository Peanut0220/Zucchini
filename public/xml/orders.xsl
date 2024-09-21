<?xml version="1.0" encoding="UTF-8"?>
<!--Author: Shi Lei-->
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- Embedding CSS styles -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Food List</title>
                <style>
                    body {
                    font-family: 'Inter', sans-serif;
                    margin: 20px;
                    background-color: #f8fafc; /* light-gray background */
                    color: #111827; /* dark text */
                    }
                    table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                    background-color: #fff; /* white background */
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* subtle shadow */
                    border-radius: 8px; /* rounded corners */
                    }
                    th, td {
                    padding: 12px 15px;
                    text-align: left;
                    border-bottom: 1px solid #e5e7eb; /* light border */
                    }
                    th {
                    background-color: #1f2937; /* dark-gray background */
                    color: #f9fafb; /* white text */
                    font-size: 14px;
                    text-transform: uppercase;
                    letter-spacing: 0.05em;
                    }
                    td {
                    font-size: 14px;
                    color: #374151; /* mid-gray text */
                    }
                    tr:nth-child(even) {
                    background-color: #f9fafb; /* light-row alternate */
                    }
                    tr:hover {
                    background-color: #e5e7eb; /* hover effect */
                    }
                    h1 {
                    font-size: 24px;
                    font-weight: 600;
                    color: #111827;
                    }
                    p {
                    font-size: 14px;
                    color: #6b7280; /* gray text */
                    }
                    hr {
                    margin-top: 20px;
                    margin-bottom: 20px;
                    border: 1px solid #e5e7eb;
                    }
                </style>
            </head>
            <body>
                <h1>Order List</h1>
                <hr/>
                <table>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Paid</th>
                        <th>Payment Type</th>
                        <th>Order Date</th>
                    </tr>
                    <xsl:for-each select="//Order">
                        <tr>
                            <td><xsl:value-of select="OrderID"/></td>
                            <td><xsl:value-of select="Total"/></td>
                            <td><xsl:value-of select="PaymentType"/></td>
                            <td><xsl:value-of select="CreatedAt"/></td>
                        </tr>
                    </xsl:for-each>
                </table>
                <hr/>
                <p>Total Orders: <xsl:value-of select="count(//Order)"/></p>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
