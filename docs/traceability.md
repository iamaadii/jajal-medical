# Traceability Matrix

This document provides verification traceability between medical device software requirements, implementation components, and automated test coverage.

| ID | Requirement (input) | Implementation (output) | Verification |
|---|---|---|---|
| REQ-001 | Admin shall be able to create a case | `CaseWebController@store`, `CaseApiController@store`, `StoreCaseRequest` | Feature test: `test_admin_can_create_a_case` |
| REQ-002 | Case Number shall be unique | Unique DB index + `StoreCaseRequest` / `UpdateCaseRequest` rule | Feature test: `test_creating_a_case_with_a_duplicate_case_number_fails` |
| REQ-003 | Only Admin shall delete cases | `CasePolicy@delete` | Feature test: `test_viewer_cannot_delete_a_case` |
