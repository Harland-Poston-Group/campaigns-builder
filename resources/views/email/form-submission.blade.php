<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
</head>
<body>
<h1>New Form Submission</h1>
<p><strong>First Name:</strong> {{ $formData['firstname'] }}</p>
<p><strong>Last Name:</strong> {{ $formData['lastname'] }}</p>
<p><strong>Email:</strong> {{ $formData['email'] }}</p>
<p><strong>Phone:</strong> {{ $formData['phone'] }}</p>
<p><strong>Interested In:</strong> {{ $formData['dropdown'] }}</p>
<p><strong>Description:</strong> {{ $formData['description'] }}</p>
<p><strong>Keep Updated:</strong> {{ $formData['keep-updated'] ? 'Yes' : 'No' }}</p>
</body>
</html>
