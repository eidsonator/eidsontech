### DRY (Don't Repeat Yourself)
Don't copy your own code.  Only copy code once (from stackoverflow), if you need to reuse
logic, move that logic into its own function and call that function.  Any change to the 
logic in the function is available every where instantly, as well as any bug fixes.

### YAGNI (You Ain't Gonna Need It)
*Don't* waste time implementing a feature that you may or may not need in the future.
*Do* waste time designing a clean and therefore extensible architecture so features are easy to 
implement in the future.
Martin Fowler has a great post on [yagni available here](https://martinfowler.com/bliki/Yagni.html).
