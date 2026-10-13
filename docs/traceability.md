# Traceability Matrix

This document provides verification traceability between medical device software requirements, implementation components, and automated test coverage.

| ID | Requirement (input) | Implementation (output) | Verification |
|---|---|---|---|
| REQ-001 | User Authentication & Role Management | `AuthController`, `User` model, RBAC policies | Feature test: `test_user_can_login_via_api` |
| REQ-002 | Admin shall be able to create, edit, view, delete | `CaseWebController`, `CaseApiController`, `CasePolicy` | Feature test: `test_admin_can_create_a_case` |
| REQ-003 | Case Number shall be unique | Unique DB index + `StoreCaseRequest` / `UpdateCaseRequest` rule | Feature test: `test_creating_a_case_with_a_duplicate_case_number_fails` |
| REQ-004 | Engineer Role (Bonus) | `CasePolicy@create`, `CasePolicy@update`, `CasePolicy@delete` | Feature test: `test_engineer_can_create_and_edit_but_not_delete` |
| REQ-005 | Viewer read-only restriction | `CasePolicy@create`, `CasePolicy@delete` | Feature test: `test_viewer_cannot_delete_a_case` |
| REQ-006 | Search & Status Filtering | `CaseWebController@index`, `CaseApiController@index` | Feature test: `test_filtering_cases_by_status_and_search` |
| REQ-007 | Priority Field & Filter (Bonus) | `cases.priority` column, `cases/index.blade.php` filter | Feature test: `test_filtering_cases_by_status_and_search` |
| REQ-008 | Column Sorting (Bonus) | Clickable table headers via `sortUrl()` query handler | Manual verification + sort query tests |
| REQ-009 | Public Holiday API (Bonus) | Nager.Date API integration (`checkDateHoliday`) | Feature test: `test_public_holiday_integration_handles_api` |
| REQ-010 | Standardized API Responses | `{ "success": bool, "data": any, "message": str }` shape | Feature test: `test_api_responses_follow_standard_shape` |
| REQ-011 | Center Delete Confirmation Modal | `openDeleteModal()` center dialog with backdrop blur | Manual verification on desktop & mobile |
