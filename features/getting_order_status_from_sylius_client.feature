@urbanara
Feature: Getting order status from Sylius client
    In order to check status of order from Sylius application
    As a User
    I want to get proper Sylius order status

    Background:
        Given the store operates on a single channel in "France"
        And there is a customer "john.doe@gmail.com" that placed an order "#00000022"
        And there is a customer "john.doe@gmail.com" that placed an order "#00000033"
        And there is a customer "john.doe@gmail.com" that placed an order "#00000044"

    Scenario: Getting order status from Sylius client
        When I want to get status of order "00000022" from "sylius" client
        Then this order status should be "cart"

    Scenario: Getting orders statuses from Sylius client
        When I want to get status of orders "00000022", "00000033" and "00000044" from "sylius" client
        Then order "00000022" status should be "cart"
        And order "00000033" status should be "cart"
        And order "00000044" status should be "cart"
