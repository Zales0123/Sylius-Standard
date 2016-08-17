@urbanara
Feature: Getting order status from Dummy client
    In order to check correctness of application logic
    As a User
    I want to get proper orders statuses from Dummy client

    Scenario: Getting order status from Dummy client
        When I want to get status of order 1 from "dummy" client
        Then this order status should be "new"

    Scenario: Getting orders statuses from Dummy client
        When I want to get status of orders 1, 2 and 3 from "dummy" client
        Then order 1 status should be "new"
        And order 2 status should be "pending"
        And order 3 status should be "cancelled"
