# PHCO
### PHCO is Cookie Management Library
PHCO is a utility class for managing HTTP cookies in PHP applications. It provides methods for adding, updating, removing, and accessing cookies, as well as checking their expiration status.

Features
* Add: Add a new cookie with a specified name, value, and optional expiration time.
* Update: Update the value and expiration time of an existing cookie or create a new one if it doesn't exist.
* Remove: Remove a cookie with the specified name.
* Get: Retrieve the value of a cookie with the specified name.
* Exists: Check if a cookie with the specified name exists.
* Expired: Check if a cookie with the specified name has expired.
* Active: Check if a cookie with the specified name is active (not expired).
* GetExpiredDetails: Retrieve the remaining time until expiration of a cookie with the specified name.
* MakeExpired: Set a cookie with the specified name to expired.
* GetAll: Retrieve all available cookies.

# Usage
### Adding a Cookie
To add a new cookie:
```
PHCO::add('username', 'john_doe', 60); // Expires in 60 minutes
```

### Updating a Cookie
To update the value and expiration time of an existing cookie or create a new one if it doesn't exist:
```
PHCO::update('username', 'jane_doe', 30); // Expires in 30 minutes
```

### Removing a Cookie
To remove a cookie with the specified name:
```
PHCO::remove('username');
```

### Retrieving a Cookie Value
To retrieve the value of a cookie with the specified name:
```
$username = PHCO::get('username');
```

### Checking if a Cookie Exists
To check if a cookie with the specified name exists:
```
if (PHCO::exists('username')) {
    // Cookie exists
} else {
    // Cookie does not exist
}
```

### Checking if a Cookie Has Expired
To check if a cookie with the specified name has expired:
```
if (PHCO::expired('username')) {
    // Cookie has expired
} else {
    // Cookie is still active
}
```

### Retrieving Remaining Time Until Expiration
To retrieve the remaining time until expiration of a cookie with the specified name:
```
$remainingTime = PHCO::getExpiredDetails('username');
```

### Setting a Cookie to Expired
To set a cookie with the specified name to expired:
```
PHCO::makeExpired('username');
```

### Retrieving All Available Cookies
To retrieve all available cookies:
```
$allCookies = PHCO::getAll();
```
