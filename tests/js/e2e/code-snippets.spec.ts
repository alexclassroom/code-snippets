import { test, expect, Page } from '@playwright/test'

const WP_LOGIN = '/wp-login.php'
const ADMIN_USER = process.env.WP_ADMIN_USER ?? 'admin'
const ADMIN_PASS = process.env.WP_ADMIN_PASS ?? 'password'

async function wpLogin(page: Page) {
	await page.goto(WP_LOGIN)
	await page.fill('#user_login', ADMIN_USER)
	await page.fill('#user_pass', ADMIN_PASS)
	await page.click('#wp-submit')
	await expect(page).toHaveURL(/\/wp-admin/)
}

test.describe('Code Snippets Plugin', () => {
	test('Admin can log in and see Code Snippets menu', async ({ page }) => {
		await wpLogin(page)
		await expect(page.locator('#adminmenu')).toContainText('Snippets')
	})

	test('Can add a new snippet', async ({ page }) => {
		await wpLogin(page)
		await page.click('text=Snippets')
		await page.click('text=Add New')
		await page.fill('#title', 'E2E Test Snippet')
		await page.fill('.CodeMirror textarea', 'echo "Hello World!";')
		await page.click('text=Save Changes')
		await expect(page.locator('.notice-success')).toContainText('Snippet added')
	})

	test('Can activate and deactivate a snippet', async ({ page }) => {
		in(page)
		await page.click('text=Snippets')
		await page.click('text=E2E Test Snippet')
		await page.click('text=Activate')
		await expect(page.locator('.row-actions span')).toContainText('Deactivate')
		await page.click('text=Deactivate')
		await expect(page.locator('.row-actions span')).toContainText('Activate')
	})

	test('Can delete a snippet', async ({ page }) => {
		await wpLogin(page)
		await page.click('text=Snippets')
		await page.click('text=E2E Test Snippet')
		await page.click('text=Delete')
		await page.click('text=OK') // Confirm dialog
		await expect(page.locator('body')).not.toContainText('E2E Test Snippet')
	})
})
