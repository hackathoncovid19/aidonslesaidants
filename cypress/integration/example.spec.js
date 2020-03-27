/// <reference types="cypress" />

context('Actions', () => {
    beforeEach(() => {
        cy.visit('http://httpd/ticket/list')
    })

    it('main has role main', () => {
        cy.get('main')
            .should('have.attr', 'role', 'main')
    })
});