<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>
        Unicourse online compiler
    </title>
</head>

<body>
    <!-- Navar Section -->
    <?php include '../nav.php'; ?>


    <!-- compiler -->
    <div data-pym-src='https://www.jdoodle.com/plugin' data-language="java"
    data-version-index="4" data-libs="mavenlib1, mavenlib2">
    public class MyClass {
    public static void main(String args[]) {
      int x=10;
      int y=25;
      int z=x+y;

      System.out.println("Sum of x+y = " + z);
    }
}
  </div>
  <script src="https://www.jdoodle.com/assets/jdoodle-pym.min.js" type="text/javascript"></script>

</body>

</html>