@urbanara
Feature: Getting order status from dummy client
    In order to check correctness of application logic
    As a User
    I want to get proper orders statuses from Dummy client

    Scenario: Getting order status from Dummy client
        When I want to get status of order 1 from "dummy" client
        Then this order status should be "new"
