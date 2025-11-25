## MEMORANDUM

**TO:** Head of Procurement, Finance Department, Business Intelligence Team
**FROM:** \[Your Name/Gemini\]
**DATE:** November 25, 2025
**SUBJECT:** Proposal for Implementation of Procurement Lifecycle Dashboard (PO-Centric)

### 1\. Introduction and Objective

This memo proposes the immediate development and implementation of **Dashboard 1 - Procurement Lifecycle (PO-Centric)**, as outlined in the attached specification (FR-2). The primary objective is to provide comprehensive, real-time visibility into procurement performance, vendor management, and financial health by leveraging our core procurement data.

### 2\. Data Source and Feasibility

The proposed dashboard is fully feasible using the data available in the **Berapit Mobility - Procurement Master Copy.xlsm** file. The necessary data fields, including purchase order details, amounts, dates, vendor names, and document classifications, are consistently available in the source data to support all required visualizations and metrics.

### 3\. Key Dashboard Components

The dashboard is structured around five core panels to provide a holistic view of the procurement process:

  * **Top-Level KPI Cards (FR-2.1):** To provide an at-a-glance status of key metrics, including:
      * Total PO Value (YTD in MYR)
      * Total Outstanding Amount (MYR)
      * Active Vendor Count
      * PO Count (Current Month vs Previous Month with % change)
  * **PO Trends Panel (FR-2.2):** Visualizing historical data on PO count and value by month (last 12 months) and a stacked bar chart to analyze PO value by major categories (R2/R3/R4/R7, OP, RV, GN, M01, CASH). It will also feature a funnel visualization of the document status distribution.
  * **Vendor Analytics Panel (FR-2.3):** Focusing on performance and concentration, including the Top 10 vendors by total spend, a pie chart showing vendor concentration, and a table for vendors with outstanding amounts.
  * **Category Intelligence Panel (FR-2.4):** Offering a treemap of spend distribution by category and subcategory, analysis of category spend trends over time, and a breakdown of Cash vs. Credit POs.
  * **Payment Health Panel (FR-2.5):** A critical section for financial oversight, displaying outstanding amounts by aging buckets (Current, 31-60, 61-90, 91-120, 120+ days) and a red flag alert list for payments overdue by more than 90 days.

### 4\. Note on Average Payment Cycle Calculation (FR-2.5.2)

It is important to note that the source file, **Berapit Mobility - Procurement Master Copy.xlsm**, does not contain a dedicated "Payment Date" column. Therefore, the precise calculation of **Average Payment Cycle (days)** cannot be determined from the available data. We will proceed with the aging analysis (FR-2.5.1 and FR-2.5.3) based on the **Purchase Order Date** but recommend that for accurate cycle time measurement, a "Payment Date" field is incorporated into the master procurement data moving forward.

### 5\. Next Steps

We recommend commencing the dashboard implementation immediately to support ongoing financial and operational review cycles.
