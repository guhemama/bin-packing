import scala.collection.mutable.ListBuffer

case class Item(weight: Int) {
    require(weight > 0, "weight must be a non-negative integer bigger than zero.")
}
case class Bin(maxWeight: Int) {
    require(maxWeight > 0, "maxWeight must be a non-negative integer bigger than zero.")

    protected val items = ListBuffer.empty[Item]

    def isEmpty(): Boolean = items.isEmpty
    def fits(item: Item): Boolean = currentWeight + item.weight <= maxWeight
    def currentWeight(): Int = items.foldLeft(0)((acc, item) => acc + item.weight)
    def remainingWeight(): Int = maxWeight - currentWeight
    def addItem(item: Item): Unit = items += item
    override def toString(): String = s"[${items.map(_.toString).mkString(", ")}]"
}

val items = List(
    Item(15), Item(55), Item(91),
    Item(56), Item(69), Item(6),
    Item(51), Item(31), Item(18),
    Item(9),  Item(61), Item(63),
    Item(1),  Item(29), Item(38),
    Item(34), Item(14), Item(40),
    Item(33), Item(17), Item(4),
    Item(8),  Item(49)
)

val maxWeight = 100

def nextFit(items: List[Item]): List[Bin] = {
    val bins = ListBuffer.empty[Bin]
    bins += Bin(maxWeight)

    items.foreach { item =>
        val lastBin = bins.lastOption.get

        if (lastBin.fits(item)) {
            lastBin.addItem(item)
        } else {
            val newBin = Bin(maxWeight)
            newBin.addItem(item)

            bins += newBin
        }
    }

    bins.toList
}

def nextFitDecreasing(items: List[Item]): List[Bin] = {
    nextFit(items.sortWith(_.weight > _.weight))
}

def firstFit(items: List[Item]): List[Bin] = {
    val bins = ListBuffer.empty[Bin]
    bins += Bin(maxWeight)

    items.foreach { item =>
        val firstFittingBin = bins
          .find(_.fits(item))
          .getOrElse(Bin(maxWeight))

        // Its a new bin, so we add it to the bins list
        if (firstFittingBin.isEmpty()) {
            bins += firstFittingBin
        }

        firstFittingBin.addItem(item)
    }

    bins.toList
}

def firstFitDecreasing(items: List[Item]): List[Bin] = {
    firstFit(items.sortWith(_.weight > _.weight))
}

def worstFit(items: List[Item]): List[Bin] = {
    val bins = ListBuffer.empty[Bin]
    bins += Bin(maxWeight)

    items.foreach { item =>
        val mostEmptyBin = bins
          .filter(_.fits(item))
          .sortWith(_.currentWeight < _.currentWeight)
          .headOption
          .getOrElse(Bin(maxWeight))

        // Its a new bin, so we add it to the bins list
        if (mostEmptyBin.isEmpty()) {
            bins += mostEmptyBin
        }

        mostEmptyBin.addItem(item)
    }

    bins.toList
}

def worstFitDecreasing(items: List[Item]): List[Bin] = {
    firstFit(items.sortWith(_.weight > _.weight))
}

println("Next fit")
println(nextFit(items).length)
println("Next fit decreasing")
println(nextFitDecreasing(items).length)

println("First fit")
println(firstFit(items).length)
println("First fit decreasing")
println(firstFitDecreasing(items).length)

println("Worst fit")
println(worstFit(items).length)
println("Worst fit decreasing")
println(worstFitDecreasing(items).length)



















