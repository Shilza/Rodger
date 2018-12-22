import sys
import time

from selenium import webdriver

driver = webdriver.Firefox()

driver.get('http://rivalregions.com')

driver.find_element_by_css_selector("div.gogo").click()

while True:
    try:
        driver.find_element_by_id("identifierId").send_keys(sys.argv[1])
        break
    except BaseException:
        pass

driver.find_element_by_id('identifierNext').click()

while True:
    try:
        password = driver.find_element_by_name('password')
        break
    except BaseException:
        pass

while not password.is_displayed():
    time.sleep(2)

password.send_keys(sys.argv[2])

driver.find_element_by_id('passwordNext').click()
while True:
    try:
        driver.find_element_by_id('header_setups')
        break
    except BaseException:
        pass

print(driver.get_cookies())
driver.close()
